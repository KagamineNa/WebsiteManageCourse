<ul style="border: 0;"class="nav nav-pills flex-column">
    <li class = "nav-item">
        <a class = "nav-link {{ activeMenu('student.account.index') ? 'active' : '' }}"
            href="{{ route('student.account.index') }}">Tổng quan</a>
    </li>
    <li class = "nav-item">
        <a class = "nav-link {{ activeMenu('student.account.profile') ? 'active' : '' }}"
            href="{{ route('student.account.profile') }}">Thông tin</a>
    </li>
    <li class = "nav-item">
        <a class = "nav-link {{ activeMenu('student.account.myCourses') ? 'active' : '' }}"
            href="{{ route('student.account.myCourses') }}">Khóa học</a>
    </li>
    <li class = "nav-item">
        <a class = "nav-link {{ activeMenu('student.account.myOrders') ? 'active' : '' }}"
            href="{{ route('student.account.myOrders') }}">Đơn hàng</a>
    </li>
    <li class = "nav-item">
        <a class = "nav-link {{ activeMenu('student.account.changePassword') ? 'active' : '' }}"
            href="{{ route('student.account.changePassword') }}">Đổi mật khẩu</a>
    </li>
    <li class = "nav-item">
        <a class = "nav-link" href="#" onclick="document['form-logout'].submit(); return false;">Đăng xuất</a>
    </li>
</ul>
