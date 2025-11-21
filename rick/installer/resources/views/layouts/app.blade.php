<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('vendor/installer/img/favicon.ico') }}" type="image/png" />
    <title>{{ installer_trans('Rick Installer') }} - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('vendor/libs/bootstrap/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/fontawesome/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/installer/css/app.min.css') }}" />
</head>

<body>
    <nav class="rick-navbar">
        <div class="container">
            <div class="rick-navbar-inner">
                <a href="https://rick.com" class="rick-logo" target="_blank">
                    <img src="{{ asset('vendor/installer/img/logo.png') }}" alt="Rick" />
                </a>
                <div class="rick-navbar-actions">
                    <a href="https://t.me/rick" class="btn btn-light btn-md"
                        target="_blank">{{ installer_trans('Get Help') }}</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="rick-section mt-auto">
        <div class="container">
            <div class="rick-section-inner">
                <div class="rick-section-body">
                    @if ($errors->any())
                        <div class="col-xxl-8 mx-auto">
                            <div class="alert alert-danger mb-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="rick-steps col-xxl-8 mx-auto">
                        <div class="rick-steps-header">
                            <div class="rick-steps-item {{ currentStep(1) }}">
                                <div class="rick-steps-item-icon">
                                    <i class="fas fa-check"></i>
                                    <div class="rick-steps-item-number">1</div>
                                </div>
                                <div class="rick-steps-item-text">{{ installer_trans('Requirements') }}</div>
                            </div>
                            <div class="rick-steps-item {{ currentStep(2) }}">
                                <div class="rick-steps-item-icon">
                                    <i class="fas fa-check"></i>
                                    <div class="rick-steps-item-number">2</div>
                                </div>
                                <div class="rick-steps-item-text">{{ installer_trans('Permissions') }}</div>
                            </div>
                            <div class="rick-steps-item {{ currentStep(3) }}">
                                <div class="rick-steps-item-icon">
                                    <i class="fas fa-check"></i>
                                    <div class="rick-steps-item-number">3</div>
                                </div>
                                <div class="rick-steps-item-text">{{ installer_trans('License') }}</div>
                            </div>
                            <div class="rick-steps-item {{ currentStep(4) }}">
                                <div class="rick-steps-item-icon">
                                    <i class="fas fa-check"></i>
                                    <div class="rick-steps-item-number">4</div>
                                </div>
                                <div class="rick-steps-item-text">{{ installer_trans('Database') }}</div>
                            </div>
                            <div class="rick-steps-item {{ currentStep(5) }}">
                                <div class="rick-steps-item-icon">
                                    <i class="fas fa-check"></i>
                                    <div class="rick-steps-item-number">5</div>
                                </div>
                                <div class="rick-steps-item-text">{{ installer_trans('Import') }}</div>
                            </div>
                            <div class="rick-steps-item {{ currentStep(6) }}">
                                <div class="rick-steps-item-icon">
                                    <i class="fas fa-check"></i>
                                    <div class="rick-steps-item-number">6</div>
                                </div>
                                <div class="rick-steps-item-text">{{ installer_trans('Completed') }}</div>
                            </div>
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="rick-footer mt-auto">
        <div class="container">
            <div class="row justify-content-sm-between align-items-center g-3">
                <div class="col-12 col-sm-auto">
                    <p class="text-muted text-center mb-0 small">
                        {{ installer_trans('Rick') }} © <span data-year></span> -
                        {{ installer_trans('All rights reserved') }}
                    </p>
                </div>
                <div class="col-12 col-sm-auto">
                    <div class="rick-footer-links">
                        <a href="https://codecanyon.net/user/rick" target="_blank"
                            class="link">{{ installer_trans('Envato') }}</a>
                        <a href="https://twitter.com/rick" target="_blank"
                            class="link">{{ installer_trans('Twitter') }}</a>
                        <a href="https://t.me/rick" target="_blank"
                            class="link">{{ installer_trans('Get Help') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('vendor/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/libs/bootstrap/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
    <script>
        "use strict";
        document.querySelectorAll("[data-year]").forEach((el) => {
            el.textContent = new Date().getFullYear();
        });
        $(".remove-spaces").on('input', function() {
            $(this).val($(this).val().replace(/\s/g, ""));
        });
    </script>
</body>

</html>
