<!--**********************************
            Sidebar start
***********************************-->
<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a class="ai-icon" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="ai-icon" href="#" aria-expanded="false">
                    <i class="flaticon-381-book"></i>
                    <span class="nav-text">Courses</span>
                    <span class="nav-text fa fa-chevron-down float-right"></span> <!-- Collapsible icon -->
                </a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="{{ route('admin.course.list') }}">All Courses</a></li>
                    <li><a href="{{ route('admin.course.add') }}">Add New Course</a></li>
                </ul>
            </li>
            <li>
                <a class="ai-icon" href="{{ route('admin.course.module.list') }}" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Course Module</span>
                </a>
            </li>
            <li>
                <a class="ai-icon" href="{{ route('admin.course.content.list') }}" aria-expanded="false">
                    <i class="flaticon-381-map-1"></i>
                    <span class="nav-text">Course Module Content</span>
                </a>
            </li>
            <li>
                <a class="ai-icon" href="#" aria-expanded="false">
                    <i class="flaticon-381-file-2"></i>
                    <span class="nav-text">Course Content Types</span>
                    <span class="nav-text fa fa-chevron-down float-right"></span> <!-- Collapsible icon -->
                </a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="{{ route('admin.content-type.list') }}">All Content Types</a></li>
                    <li><a href="{{ route('admin.content-type.add') }}">Add New Content Type</a></li>
                </ul>
            </li>
            <li>
                <a class="ai-icon" href="#" aria-expanded="false">
                    <i class="flaticon-381-book"></i>
                    <span class="nav-text">Students Feedback</span>
                    <span class="nav-text fa fa-chevron-down float-right"></span> <!-- Collapsible icon -->
                </a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="{{ route('admin.student-feedback.list') }}">All Students Feedback</a></li>
                    <li><a href="{{ route('admin.student-feedback.add') }}">Add Student Feedback</a></li>
                </ul>
            </li>
            <li class="@if (in_array(request()->route()->getName(), ['admin.tags.index','admin.tag.create'])) mm-active @endif">
                <a class="ai-icon" href="{{ route('admin.tags.index') }}" aria-expanded="true">
                    <i class="flaticon-381-file-2"></i>
                    <span class="nav-text">Tags</span>
                    <span class="nav-text fa fa-chevron-down float-right"></span> <!-- Collapsible icon -->
                </a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="{{ route('admin.tags.index') }}">All Tags</a></li>
                    <li><a href="{{ route('admin.tags.create') }}">Add New Tag</a></li>
                </ul>
            </li>
            <li class="@if(str_contains(request()->route()->getName(), 'admin.cms')) mm-active @endif">
                <a class="ai-icon" href="{{ route('admin.cms.list') }}" aria-expanded="true">
                    <i class="flaticon-381-file-2"></i>
                    <span class="nav-text">Cms Pages</span>
                    <span class="nav-text fa fa-chevron-down float-right"></span> <!-- Collapsible icon -->
                </a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="{{ route('admin.cms.list') }}">All Cms Pages</a></li>
                    <li><a href="{{ route('admin.cms.add') }}">Add New Cms Page</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->
