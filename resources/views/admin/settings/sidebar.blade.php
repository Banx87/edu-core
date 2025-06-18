<div class="col-12 col-md-3 border-end">
    <div class="card-body">
        <h4 class="subheader">Platform settings</h4>
        <div class="list-group list-group-transparent">
            <a href="{{ route('admin.settings.general-settings') }}"
                class="list-group-item list-group-item-action d-flex align-items-center {{ sidebarItemActive(['admin.settings.general-settings']) }}">General
                Settings</a>
            <a href="{{ route('admin.settings.logo.index') }}"
                class="list-group-item list-group-item-action d-flex align-items-center {{ sidebarItemActive(['admin.settings.logo.index']) }}">Logo
                & Favicon</a>
            <a href="{{ route('admin.settings.commissions.index') }}"
                class="list-group-item list-group-item-action d-flex align-items-center {{ sidebarItemActive(['admin.settings.commissions.index']) }}">Commission
                Settings</a>
            <a href="{{ route('admin.settings.smtp-settings') }}"
                class="list-group-item list-group-item-action d-flex align-items-center {{ sidebarItemActive(['admin.settings.smtp-settings']) }}">SMTP
                Settings</a>
            {{-- <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">Connected
                Apps</a>
            <a href="./settings-plan.html"
                class="list-group-item list-group-item-action d-flex align-items-center">Plans</a>
            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">Billing
                &amp; Invoices</a> --}}
        </div>
        {{-- <h4 class="subheader mt-4">Experience</h4>
        <div class="list-group list-group-transparent">
            <a href="#" class="list-group-item list-group-item-action">Give
                Feedback</a>
        </div> --}}
    </div>
</div>
