@include('Layouts.Partials.header')

@include('Layouts.Partials.sidebar')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h4>SI Pengaduan Layanan Sepatu</h4>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href={{ '/' . Request::path() }}>{{ Request::path() }}</a>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="container-fluid">

                @yield('content')
            </div>
        </div>




    </section>
</div>

@include('Layouts.Partials.footer')
