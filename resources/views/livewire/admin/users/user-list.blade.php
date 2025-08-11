<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="خرده نان">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);">صفحه اصلی</a>
            </li>
            <li class="breadcrumb-item">
                <a href="javascript:void(0);">رابط کاربری</a>
            </li>
            <li class="breadcrumb-item active">مسیر ها</li>
        </ol>
    </nav>
    <div class="card">
        <h5 class="card-header">لیست کاربران</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>آیدی بله</th>
                    <th>نام کاربر</th>
                    <th>ارسال پیام</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($users as $index => $user)
                    <tr>
                        <td>{{$users->firstItem() + $index}}</td>
                        <td>{{$user->bale_id}}</td>
                        <td>{{$user->first_name}}</td>
                        <td><button wire:click="sendMessage({{$user->bale_id}})"  class="btn btn-info">ارسال پیام</button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="demo-inline-spacing">
            <nav aria-label="پیمایش صفحه">
                {{$users->links()}}
{{--                <ul class="pagination justify-content-center">--}}
{{--                    <li class="page-item prev">--}}
{{--                        <a--}}
{{--                            class="page-link waves-effect"--}}
{{--                            href="javascript:void(0);"--}}
{{--                        >--}}
{{--                            <i class="ti ti-chevrons-right ti-xs"></i>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="page-item">--}}
{{--                        <a--}}
{{--                            class="page-link waves-effect"--}}
{{--                            href="javascript:void(0);"--}}
{{--                        >1</a--}}
{{--                        >--}}
{{--                    </li>--}}
{{--                    <li class="page-item">--}}
{{--                        <a--}}
{{--                            class="page-link waves-effect"--}}
{{--                            href="javascript:void(0);"--}}
{{--                        >2</a--}}
{{--                        >--}}
{{--                    </li>--}}
{{--                    <li class="page-item active">--}}
{{--                        <a--}}
{{--                            class="page-link waves-effect"--}}
{{--                            href="javascript:void(0);"--}}
{{--                        >3</a--}}
{{--                        >--}}
{{--                    </li>--}}
{{--                    <li class="page-item">--}}
{{--                        <a--}}
{{--                            class="page-link waves-effect"--}}
{{--                            href="javascript:void(0);"--}}
{{--                        >4</a--}}
{{--                        >--}}
{{--                    </li>--}}
{{--                    <li class="page-item">--}}
{{--                        <a--}}
{{--                            class="page-link waves-effect"--}}
{{--                            href="javascript:void(0);"--}}
{{--                        >5</a>--}}
{{--                    </li>--}}
{{--                    <li class="page-item next">--}}
{{--                        <a--}}
{{--                            class="page-link waves-effect"--}}
{{--                            href="javascript:void(0);"--}}
{{--                        >--}}
{{--                            <i class="ti ti-chevrons-left ti-xs"></i>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
            </nav>
        </div>
    </div>
</div>
