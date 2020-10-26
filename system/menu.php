<div class="app-sidebar sidebar-shadow bg-midnight-bloom sidebar-text-light">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">ผู้กระทำความผิด</li>
                <li>
                    <a href="./?mode=offender/index" class="<?php if(strstr($_GET['mode'], "offender/")){ echo "mm-active"; } ?>"><i class="metismenu-icon pe-7s-shield"></i> รายงานผู้กระทำความผิด </a>
                </li>
                <li>
                    <a href="./?mode=plaint/index" class="<?php if(strstr($_GET['mode'], "plaint/")){ echo "mm-active"; } ?>"><i class="metismenu-icon pe-7s-paperclip"></i> ข้อหา </a>
                </li>
                <li>
                    <a href="./?mode=material/index" class="<?php if(strstr($_GET['mode'], "material/")){ echo "mm-active"; } ?>"><i class="metismenu-icon pe-7s-drop"></i> ของกลาง </a>
                </li>
                <li class="app-sidebar__heading"> พนักงาน </li>
                <li>
                    <a href="./?mode=employee/index" class="<?php if(strstr($_GET['mode'], "employee/")){ echo "mm-active"; } ?>"><i class="metismenu-icon pe-7s-users"></i> รายงานพนักงาน </a>
                </li>
            </ul>
        </div>
    </div>
</div>