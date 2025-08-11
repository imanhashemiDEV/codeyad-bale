<aside
    class="layout-menu menu-vertical menu bg-menu-theme"
    id="layout-menu"
>
    <div class="app-brand demo">
        <a class="app-brand-link" href="index.html">
              <span class="app-brand-logo demo">
                <svg
                    fill="none"
                    height="22"
                    viewBox="0 0 32 22"
                    width="32"
                    xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                      clip-rule="evenodd"
                      d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                      fill="#7367F0"
                      fill-rule="evenodd"
                  />
                  <path
                      clip-rule="evenodd"
                      d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                      fill="#161616"
                      fill-rule="evenodd"
                      opacity="0.06"
                  />
                  <path
                      clip-rule="evenodd"
                      d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                      fill="#161616"
                      fill-rule="evenodd"
                      opacity="0.06"
                  />
                  <path
                      clip-rule="evenodd"
                      d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                      fill="#7367F0"
                      fill-rule="evenodd"
                  />
                </svg>
              </span>
            <span class="app-brand-text demo menu-text fw-bold"
            >پنل مدیریت</span
            >
        </a>
        <a
            class="layout-menu-toggle menu-link text-large ms-auto"
            href="javascript:void(0);"
        >
            <i
                class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"
            ></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Page -->
        <li class="menu-header small text-uppercase">
              <span class="menu-header-text" data-i18n="Forms & Tables"
              >دسته بندی منو</span
              >
        </li>
        <li class="menu-header small text-uppercase">
              <span class="menu-header-text" data-i18n="Forms & Tables"
              >کاربران</span
              >
        </li>
        <!-- Forms -->
        <li class="menu-item">
            <a class="menu-link menu-toggle" href="javascript:void(0);">
                <i class="menu-icon tf-icons ti ti-toggle-left"></i>
                <div data-i18n="Form Elements">کاربران</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item active">
                    <a class="menu-link" href="{{route('panel.users')}}">
                        <div data-i18n="Basic Inputs">لیست کاربران</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
