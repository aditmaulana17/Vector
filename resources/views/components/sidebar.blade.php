<div>
    <nav class="pc-sidebar">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="/dashboard" class="b-brand text-primary">
                    <span>Aplikasi Manajemen Pegawai</span>
                </a>
            </div>

            <div class="navbar-content">
                <ul class="pc-navbar">

                    {{-- Semua role --}}
                    <x-sidebar.links 
                        title="Dashboard" 
                        icon="ti ti-home" 
                        route="home" />

                    
                    {{-- Admin saja --}}
                    @if (Auth::user()->role_id == 2)

                        <x-sidebar.links 
                            title="Data User" 
                            icon="ti ti-user" 
                            route="users.index" />

                    @endif



                    {{-- Admin + Supervisor --}}
                    @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 )

                        <x-sidebar.links 
                            title="Data Pegawai" 
                            icon="ti ti-report-analytics" 
                            route="pegawai.index" />

                    @endif



                    {{-- Admin saja --}}
                    @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)

                        <x-sidebar.links 
                            title="Data Bagian" 
                            icon="ti ti-briefcase" 
                            route="bagian.index" />

                    @endif


                </ul>
            </div>
        </div>
    </nav>
</div>
