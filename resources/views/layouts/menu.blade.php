@if(Request::is('analytics*'))
<li class="header"></li>

<li class="{{ Request::is('analytics*') ? 'active' : '' }}">
    <a href="{!! url('analytics') !!}"><i class="fa fa-area-chart"></i><span>Analytics</span></a>
</li>
@endif
{{--
@if(Request::is('assets*'))
<li class="header">MANAGEMENT</li>

<li class="{{ Request::is('assets*') ? 'active' : '' }}">
    <a href="{!! url('assets') !!}"><i class="fa fa-folder-open"></i><span>Assets</span></a>
</li>
@endif
--}}

@role(['superadministrator'])
@if(Request::is('users*') or Request::is('profiles*') or Request::is('roles*') 
or Request::is('permissions*')
or Request::is('jabatans*')
or  Request::is('cabangs*')

)
<li class="header"></li>

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-users"></i><span>Users</span></a>
</li>

<li class="{{ Request::is('profiles*') ? 'active' : '' }}">
    <a href="{!! route('profiles.index') !!}"><i class="fa fa-edit"></i><span>Profiles</span></a>
</li>

<li class="{{ Request::is('roles*') ? 'active' : '' }}">
    <a href="{!! route('roles.index') !!}"><i class="fa fa-road"></i><span>Roles</span></a>
</li>

<li class="{{ Request::is('permissions*') ? 'active' : '' }}">
    <a href="{!! route('permissions.index') !!}"><i class="fa fa-ticket"></i><span>Permissions</span></a>
</li>
<li class="{{ Request::is('jabatans*') ? 'active' : '' }}">
    <a href="{!! route('jabatans.index') !!}"><i class="fa fa-suitcase"></i><span>Occupation</span></a>
</li>
<li class="{{ Request::is('cabangs*') ? 'active' : '' }}">
    <a href="{!! route('cabangs.index') !!}"><i class="fa fa-map-marker"></i><span>Branch</span></a>
</li>





@endif
@endrole

@role(['superadministrator','administrator'])
@if(Request::is('settings*'))
<li class="header">CONFIGURATION</li>

<li class="{{ Request::is('settings*') ? 'active' : '' }}">
    <a href="{!! route('settings.index') !!}"><i class="fa fa-cog"></i><span>Settings</span></a>
</li>
@endif
@endrole

@if(Request::is('steps*')
    )
<li class="header">Master</li>
<li class="{{ Request::is('steps*') ? 'active' : '' }}">
    <a href="{!! route('steps.index') !!}"><i class="fa fa-edit"></i><span>Steps</span></a>
</li>


<li class="header">nonedisplaySubclass</li>

<li class="{{ Request::is('articleLines*') ? 'active' : '' }}">
    <a href="{!! route('articleLines.index') !!}"><i class="fa fa-edit"></i><span>Article Lines</span></a>
</li>
<li class="{{ Request::is('suratKeluarBarangLines*') ? 'active' : '' }}">
    <a href="{!! route('suratKeluarBarangLines.index') !!}"><i class="fa fa-edit"></i><span>Surat Keluar Barang Lines</span></a>
</li>

<li class="{{ Request::is('operatorJahits*') ? 'active' : '' }}">
    <a href="{!! route('operatorJahits.index') !!}"><i class="fa fa-edit"></i><span>Operator Jahits</span></a>
</li>

<li class="{{ Request::is('operatorBuangBenangs*') ? 'active' : '' }}">
    <a href="{!! route('operatorBuangBenangs.index') !!}"><i class="fa fa-edit"></i><span>Operator Buang Benangs</span></a>
</li>

<li class="{{ Request::is('operatorGosoks*') ? 'active' : '' }}">
    <a href="{!! route('operatorGosoks.index') !!}"><i class="fa fa-edit"></i><span>Operator Gosoks</span></a>
</li>



@endif


@if(Request::is('suratKeluarBarangs*')or
    Request::is('suratPerintahKerjas*')or
    Request::is('articles')
    )
<li class="header">Modul</li>
<li class="{{ Request::is('suratKeluarBarangs*') ? 'active' : '' }}">
    <a href="{!! route('suratKeluarBarangs.index') !!}"><i class="fa fa-edit"></i><span>Surat Keluar Barangs</span></a>
</li>    
<li class="{{ Request::is('suratPerintahKerjas*') ? 'active' : '' }}">
    <a href="{!! route('suratPerintahKerjas.index') !!}"><i class="fa fa-edit"></i><span>Surat Perintah Kerjas</span></a>
</li>
<li class="{{ Request::is('articles*') ? 'active' : '' }}">
    <a href="{!! route('articles.index') !!}"><i class="fa fa-edit"></i><span>Articles</span></a>
</li>

<li class="{{ Request::is('articles*') ? 'active' : '' }}">
    <a href="{!! route('articles.index') !!}"><i class="fa fa-edit"></i><span>Quality Control</span></a>
</li>

<li class="{{ Request::is('articles*') ? 'active' : '' }}">
    <a href="{!! route('articles.index') !!}"><i class="fa fa-edit"></i><span>Rewards</span></a>
</li>


@endif

