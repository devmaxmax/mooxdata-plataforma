<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - Burra</title>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ route('burra.assets', ['type' => 'css', 'filename' => 'app.css']) }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div class="container">
        <div class="header">
            <div class="brand">
                <img src="{{ route('burra.assets', ['type' => 'img', 'filename' => 'logo.jpg']) }}"
                    alt="Burra Comida Mexicana">
            </div>

            <div class="toggle-container">
                <button class="toggle-btn active" onclick="switchView('pedidos')">Pedidos</button>
                <button class="toggle-btn" onclick="switchView('productos')">Productos</button>
                <button class="toggle-btn" onclick="switchView('categorias')">Categorias</button>
                <button class="toggle-btn" onclick="switchView('whatsapp')">Whatsapp</button>
            </div>

            <div style="display: flex; align-items: center; gap: 10px;">
                <button id="btnAddProduct" class="btn-add" onclick="toggleModal(true)">
                    <i class="ph ph-plus-circle" style="font-size: 20px;"></i>
                    Nuevo Producto
                </button>

                <button id="btnAddCategory" class="btn-add" onclick="toggleCategoryModal(true)" style="display: none;">
                    <i class="ph ph-plus-circle" style="font-size: 20px;"></i>
                    Nueva Categoría
                </button>

                <form action="{{ route('burra.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-add"
                        style="background-color: #f87171; border-color: #f87171;; display: flex; align-items: center; gap: 8px;">
                        <i class="ph ph-sign-out" style="font-size: 20px;"></i>
                        Salir
                    </button>
                </form>
                <div id="spacer" style="width: 140px; display: none;"></div>
            </div>
        </div>

        @if ($errors->any())
            <div class="card" style="margin-bottom: 20px; background-color: #fef2f2; border: 1px solid #f87171;">
                <div style="color: #991b1b; font-weight: 500;">
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        @foreach ($errors->all() as $error)
                            <li style="display: flex; align-items: center; gap: 8px;">
                                <i class="ph ph-warning-circle"></i>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    @if ($errors->has('name') || $errors->has('price') || $errors->has('category_id'))
                        toggleModal(true);
                    @endif
                });
            </script>
        @endif

        <div id="view-pedidos" class="view-section active">
            <div class="card">
                <table>
                    <thead>
                        <tr>
                            <th>N° Pedido</th>
                            <th>Cliente</th>
                            <th>Detalle (Productos)</th>
                            <th>Estado Pago</th>
                            <th style="text-align: right;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="table-orders">
                        @foreach ($orders as $order)
                            <tr id="order-{{ $order->id }}">
                                <td style="font-weight: 700; color: var(--primary-dark);">#{{ $order->table_number }}
                                </td>
                                <td style="font-weight: 600;">Mesa {{ $order->table_number }}</td>
                                <td style="color: var(--text-light);">
                                    @foreach ($order->items as $item)
                                        <div>{{ $item->quantity }}x {{ $item->product_name ?? 'N/A' }}</div>
                                    @endforeach
                                </td>
                                <td>
                                    <span class="badge {{ $order->status === 'paid' ? 'paid' : 'pending' }}">
                                        {{ $order->status === 'paid' ? 'Pagado' : ($order->status === 'pending' ? 'Pendiente' : $order->status) }}
                                    </span>
                                </td>
                                <td style="text-align: right;">
                                    <button class="btn-action btn-cancel" onclick="cancelOrder('{{ $order->id }}')">
                                        <i class="ph ph-x-circle" style="font-size: 16px;"></i>
                                        Cancelar
                                    </button>
                                    <button class="btn-action btn-approve"
                                        onclick="approveOrder('{{ $order->id }}')">
                                        <i class="ph ph-check-circle" style="font-size: 16px;"></i>
                                        Aprobar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div id="view-productos" class="view-section">
            <div class="card">
                <table>
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Vars</th>
                            <th>Precio</th>
                            <th>Estado</th>
                            <th style="text-align: right;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="table-products">
                        @foreach ($products as $product)
                            <tr>
                                <td><span class="product-type">{{ $product->category->name ?? 'Sin categoría' }}</span>
                                </td>
                                <td style="font-weight: 700;">{{ $product->name }}</td>
                                <td style="color: var(--text-light); font-size: 13px;">{{ $product->description }}</td>
                                <td style="font-size: 13px; color: var(--text-lighter);">
                                    {{ $product->variable ?? '-' }}
                                </td>
                                <td style="font-weight: 800; color: var(--primary);">
                                    ${{ number_format($product->price, 2) }}</td>
                                <td>
                                    <span
                                        class="badge {{ $product->is_active ? 'active-status' : 'inactive-status' }}">
                                        {{ $product->is_active ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td style="text-align: right; white-space: nowrap;">
                                    <button class="icon-action" title="Cambiar Estado"
                                        onclick="toggleProductStatus({{ $product->id }})">
                                        <i class="ph ph-power"></i>
                                    </button>
                                    <button class="icon-action" title="Editar"
                                        onclick='openEditModal({{ $product->id }})'>
                                        <i class="ph ph-pencil-simple"></i>
                                    </button>
                                    <button class="icon-action delete" title="Eliminar"
                                        onclick="deleteProduct({{ $product->id }}, '{{ addslashes($product->name) }}')">
                                        <i class="ph ph-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div id="view-categorias" class="view-section">
            <div class="card">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th style="text-align: right;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="table-categories">
                        {{-- JS will render here --}}
                    </tbody>
                </table>
            </div>
        </div>

        <div id="view-whatsapp" class="view-section">
        </div>
    </div>

    {{-- Product Modal --}}
    <div class="modal-overlay" id="productModal">
        <div class="modal-box">
            <div class="modal-header">
                <h3 class="modal-title">Agregar Nuevo Producto</h3>
                <i class="ph ph-x modal-close" onclick="toggleModal(false)"></i>
            </div>
            <form id="productForm" method="POST" action="{{ route('burra.products.store') }}">
                @csrf
                <div id="methodField"></div>
                <input type="hidden" id="productId" name="product_id">

                <div class="form-group">
                    <label class="form-label">Tipo de Producto (Categoría)</label>
                    <select class="form-select" name="category_id" id="productCategory">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-input" id="productName" name="name"
                        placeholder="Ej: Burrito XL" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Descripción</label>
                    <input type="text" class="form-input" id="productDescription" name="description"
                        placeholder="Ingredientes breves..." required>
                </div>
                <div class="form-group">
                    <label class="form-label">Variables (Opcional)</label>
                    <input type="text" class="form-input" id="productVariable" name="variable"
                        placeholder="Ej: Picante / Sin Picante">
                </div>
                <div class="form-group">
                    <label class="form-label">Precio</label>
                    <input type="number" class="form-input" id="productPrice" name="price" placeholder="0.00"
                        step="0.01" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-action"
                        style="background: var(--border-light); color: var(--text-main); padding: 10px 20px; font-weight: 600;"
                        onclick="toggleModal(false)">
                        Cancelar
                    </button>
                    <button type="submit" class="btn-action btn-approve" style="padding: 10px 24px;">
                        Guardar Producto
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Category Modal --}}
    <div class="modal-overlay" id="categoryModal">
        <div class="modal-box">
            <div class="modal-header">
                <h3 class="modal-title" id="catModalTitle">Agregar Nueva Categoría</h3>
                <i class="ph ph-x modal-close" onclick="toggleCategoryModal(false)"></i>
            </div>
            <form id="categoryForm" method="POST" action="{{ route('burra.categories.store') }}">
                @csrf
                <div id="catMethodField"></div>
                <input type="hidden" id="catId" name="category_id">

                <div class="form-group">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-input" id="catName" name="name"
                        placeholder="Ej: Bebidas" required>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-action"
                        style="background: var(--border-light); color: var(--text-main); padding: 10px 20px; font-weight: 600;"
                        onclick="toggleCategoryModal(false)">
                        Cancelar
                    </button>
                    <button type="submit" class="btn-action btn-approve" id="catBtnSubmit"
                        style="padding: 10px 24px;">
                        Guardar Categoría
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Formulario oculto para eliminar --}}
    <form id="deleteForm" method="POST" action="" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    <script src="{{ route('burra.assets', ['type' => 'js', 'filename' => 'app.js', 'v' => time()]) }}"></script>

    <script>
        const products = @json($products);
        const categories = @json($categories);
        renderProducts();
        renderCategories();

        // View Persistence
        const initialView = "{{ session('view', 'pedidos') }}";
        // Check if function exists before calling, in case of load race condition (though script order handles this)
        if (typeof switchView === 'function') {
            switchView(initialView);
        }
    </script>

</body>

</html>
