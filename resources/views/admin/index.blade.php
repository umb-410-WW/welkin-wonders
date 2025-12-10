<<<<<<< HEAD
@extends('layouts.ww_layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
    <h1>Admin Dashboard!</h1>
    <a href="{{ route('products.create') }}">Create a product</a>
    <form method="POST" action="{{ route('logout') }}">
        <input type="submit" value="Logout"></form>
        @csrf
        @forelse ($products as $product)
            <x-ww_components.admin-product-card :product="$product"></x-ww_components.admin-product-card>
            {{-- Display a message if there are no products in the database --}}
        @empty
            <p>No products are available at the moment. Stay tuned!</p>
        @endforelse
@endsection
=======


@php
    $user = Auth::user();
@endphp

<style>
:root{
  --bg: #140c1c;
  --panel: #1c1229;
  --panel-2: #120a1c;
  --text: #e7d6ff;
  --muted: #a992d8;
  --brand: #7c3aed;
  --accent:#9f67ff;
  --shadow: rgba(124,58,237,0.25);
}

html, body {
  background: var(--bg) !important;
  color: var(--text) !important;
  height:100%;
}

/* REMOVE Jetstream padding */
main {
  padding:0 !important;
}

/* ADMIN NAV */
.admin-nav{
  display:flex;
  justify-content:space-between;
  align-items:center;
  padding:16px 28px;
  background:#0e0716;
  border-bottom:1px solid #2d2045;
  box-shadow:0 2px 10px var(--shadow);
}
.admin-nav-title{
  font-size:20px;
  font-weight:700;
  color:var(--text);
}
.admin-nav-menu{
  display:flex;
  gap:18px;
  align-items:center;
}
.admin-nav-menu span{
  opacity:.85;
}

/* SIDEBAR */
.sidebar{
  width:220px;
  background:var(--panel);
  position:fixed;
  top:58px; left:0; bottom:0;
  border-right:1px solid #32234e;
  padding-top:24px;
}
.sidebar a{
  display:block;
  padding:14px 18px;
  color:var(--text);
  text-decoration:none;
  border-left:3px solid transparent;
  font-weight:500;
  transition:0.25s;
}
.sidebar a:hover,
.sidebar a.active{
  background:var(--panel-2);
  border-left-color:var(--brand);
}

/* MAIN CONTENT */
.main{
  margin-left:220px;
  padding:24px;
}

/* KPI CARDS */
.kpi-grid{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:18px;
}
.kpi{
  background:var(--panel-2);
  padding:20px;
  border-radius:16px;
  border:1px solid #362454;
  color:var(--text);
  box-shadow:0 2px 8px var(--shadow);
}
.label{color:var(--muted);font-size:12px;margin-bottom:6px;}
.value{font-size:26px;font-weight:700;}

/* PANELS */
.panel{
  background:var(--panel-2);
  border:1px solid #362454;
  border-radius:16px;
  margin-top:24px;
  padding:18px;
}
.panel h3{margin-bottom:12px;color:var(--text);}

.grid-2{display:grid;grid-template-columns:1fr 1fr;gap:16px;}

.table th, .table td{
  color:var(--text);
  border-bottom:1px solid #3e2d5c;
}
.pill{background:#1c1229;padding:2px 8px;border-radius:20px;}

@media(max-width:900px){
  .kpi-grid{grid-template-columns:repeat(2,1fr)}
  .grid-2{grid-template-columns:1fr}
}
</style>


<!-- CUSTOM ADMIN NAV (NO LARAVEL TOP BAR) -->
<div class="admin-nav">
  <div class="admin-nav-title">Welkin Wonders Admin</div>

  <div class="admin-nav-menu">
      <span>Hello, {{ $user->name }}</span>
      <a href="{{ url('/') }}" style="color:var(--text);text-decoration:none;">Back to Shop</a>
      <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button style="all:unset;cursor:pointer;color:var(--brand);text-decoration:underline;">Logout</button>
      </form>
  </div>
</div>


<!-- SIDEBAR -->
<nav class="sidebar">
    <a data-section="dashboard" class="active">Dashboard</a>
    <a data-section="products">Products</a>
    <a data-section="customers">Customers</a>
    <a data-section="settings">Settings</a>
</nav>


<!-- MAIN -->
<main class="main">

    <h2 style="font-size:22px;margin-bottom:18px;">Overview</h2>

    <!-- KPIs -->
    <section class="kpi-grid">
        <div class="kpi"><div class="label">Total sales</div><div id="kpi-sales" class="value">$0</div></div>
        <div class="kpi"><div class="label">Orders</div><div id="kpi-orders" class="value">0</div></div>
        <div class="kpi"><div class="label">Visitors</div><div id="kpi-visitors" class="value">0</div></div>
        <div class="kpi"><div class="label">Conversion</div><div id="kpi-cr" class="value">0%</div></div>
    </section>

    <!-- CHARTS -->
    <section class="panel">
        <h3>Sales</h3>
        <canvas id="salesChart" height="120"></canvas>
    </section>

    <div class="grid-2">
        <div class="panel">
            <h3>Orders</h3>
            <canvas id="ordersChart" height="120"></canvas>
        </div>
        <div class="panel">
            <h3>Top products</h3>
            <table class="table" id="topProductsTable">
                <thead><tr><th>Product</th><th>Units</th><th>Revenue</th></tr></thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

</main>


<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labels=['Day 1','Day 2','Day 3','Day 4','Day 5'];

new Chart(document.getElementById('salesChart'),{
  type:'line',
  data:{labels,datasets:[{data:[2,4,3,5,6],borderColor:"#7c3aed",tension:.3}]},
  options:{plugins:{legend:{display:false}},scales:{y:{ticks:{color:"#cbb8ff"}}}}
});
new Chart(document.getElementById('ordersChart'),{
  type:'bar',
  data:{labels,datasets:[{data:[1,2,0,3,1],backgroundColor:"#7c3aed"}]},
  options:{plugins:{legend:{display:false}},scales:{y:{ticks:{color:"#cbb8ff"}}}}
});
</script>
>>>>>>> thea


@php
    $user = Auth::user();
@endphp

<style>
:root{
  --bg: #140c1c;
  --panel: #1c1229;
  --panel-2: #120a1c;
  --text: #e7d6ff;
  --muted: #a992d8;
  --brand: #7c3aed;
  --accent:#9f67ff;
  --shadow: rgba(124,58,237,0.25);
}

html, body {
  background: var(--bg) !important;
  color: var(--text) !important;
  height:100%;
}

/* REMOVE Jetstream padding */
main {
  padding:0 !important;
}

/* ADMIN NAV */
.admin-nav{
  display:flex;
  justify-content:space-between;
  align-items:center;
  padding:16px 28px;
  background:#0e0716;
  border-bottom:1px solid #2d2045;
  box-shadow:0 2px 10px var(--shadow);
}
.admin-nav-title{
  font-size:20px;
  font-weight:700;
  color:var(--text);
}
.admin-nav-menu{
  display:flex;
  gap:18px;
  align-items:center;
}
.admin-nav-menu span{
  opacity:.85;
}

/* SIDEBAR */
.sidebar{
  width:220px;
  background:var(--panel);
  position:fixed;
  top:58px; left:0; bottom:0;
  border-right:1px solid #32234e;
  padding-top:24px;
}
.sidebar a{
  display:block;
  padding:14px 18px;
  color:var(--text);
  text-decoration:none;
  border-left:3px solid transparent;
  font-weight:500;
  transition:0.25s;
}
.sidebar a:hover,
.sidebar a.active{
  background:var(--panel-2);
  border-left-color:var(--brand);
}

/* MAIN CONTENT */
.main{
  margin-left:220px;
  padding:24px;
}

/* KPI CARDS */
.kpi-grid{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:18px;
}
.kpi{
  background:var(--panel-2);
  padding:20px;
  border-radius:16px;
  border:1px solid #362454;
  color:var(--text);
  box-shadow:0 2px 8px var(--shadow);
}
.label{color:var(--muted);font-size:12px;margin-bottom:6px;}
.value{font-size:26px;font-weight:700;}

/* PANELS */
.panel{
  background:var(--panel-2);
  border:1px solid #362454;
  border-radius:16px;
  margin-top:24px;
  padding:18px;
}
.panel h3{margin-bottom:12px;color:var(--text);}

.grid-2{display:grid;grid-template-columns:1fr 1fr;gap:16px;}

.table th, .table td{
  color:var(--text);
  border-bottom:1px solid #3e2d5c;
}
.pill{background:#1c1229;padding:2px 8px;border-radius:20px;}

@media(max-width:900px){
  .kpi-grid{grid-template-columns:repeat(2,1fr)}
  .grid-2{grid-template-columns:1fr}
}
</style>


<!-- CUSTOM ADMIN NAV (NO LARAVEL TOP BAR) -->
<div class="admin-nav">
  <div class="admin-nav-title">Welkin Wonders Admin</div>

  <div class="admin-nav-menu">
      <span>Hello, {{ $user->name }}</span>
      <a href="{{ url('/') }}" style="color:var(--text);text-decoration:none;">Back to Shop</a>
      <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button style="all:unset;cursor:pointer;color:var(--brand);text-decoration:underline;">Logout</button>
      </form>
  </div>
</div>


<!-- SIDEBAR -->
<nav class="sidebar">
    <a data-section="dashboard" class="active">Dashboard</a>
    <a data-section="products">Products</a>
    <a data-section="customers">Customers</a>
    <a data-section="settings">Settings</a>
</nav>


<!-- MAIN -->
<main class="main">

    <h2 style="font-size:22px;margin-bottom:18px;">Overview</h2>

    <!-- KPIs -->
    <section class="kpi-grid">
        <div class="kpi"><div class="label">Total sales</div><div id="kpi-sales" class="value">$0</div></div>
        <div class="kpi"><div class="label">Orders</div><div id="kpi-orders" class="value">0</div></div>
        <div class="kpi"><div class="label">Visitors</div><div id="kpi-visitors" class="value">0</div></div>
        <div class="kpi"><div class="label">Conversion</div><div id="kpi-cr" class="value">0%</div></div>
    </section>

    <!-- CHARTS -->
    <section class="panel">
        <h3>Sales</h3>
        <canvas id="salesChart" height="120"></canvas>
    </section>

    <div class="grid-2">
        <div class="panel">
            <h3>Orders</h3>
            <canvas id="ordersChart" height="120"></canvas>
        </div>
        <div class="panel">
            <h3>Top products</h3>
            <table class="table" id="topProductsTable">
                <thead><tr><th>Product</th><th>Units</th><th>Revenue</th></tr></thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

</main>


<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labels=['Day 1','Day 2','Day 3','Day 4','Day 5'];

new Chart(document.getElementById('salesChart'),{
  type:'line',
  data:{labels,datasets:[{data:[2,4,3,5,6],borderColor:"#7c3aed",tension:.3}]},
  options:{plugins:{legend:{display:false}},scales:{y:{ticks:{color:"#cbb8ff"}}}}
});
new Chart(document.getElementById('ordersChart'),{
  type:'bar',
  data:{labels,datasets:[{data:[1,2,0,3,1],backgroundColor:"#7c3aed"}]},
  options:{plugins:{legend:{display:false}},scales:{y:{ticks:{color:"#cbb8ff"}}}}
});
</script>

