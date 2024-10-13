@extends('layouts.web')
@push('css')
    <link rel="stylesheet" href="{{ asset('web/mycss/mycss.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/libs/glightbox/css/glightbox.min.css') }}">
@endpush
@section('title')
    Chats
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">

            <div class="container-fluid">
                <div class="chat-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
                    {{-- <div class="chat-leftsidebar">
                        <div class="px-4 pt-4 mb-3">
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <h5 class="mb-4">Chats</h5>
                                </div>
                                <div class="flex-shrink-0">
                                    <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom"
                                        title="Add Contact">

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-soft-primary btn-sm">
                                            <i class="ri-add-line align-bottom"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="search-box">
                                <input type="text" class="form-control bg-light border-light"
                                    placeholder="Search here...">
                                <i class="ri-search-2-line search-icon"></i>
                            </div>
                        </div> <!-- .p-4 -->

                        <ul class="nav nav-tabs nav-tabs-custom nav-success nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#chats" role="tab">
                                    Chats
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#contacts" role="tab">
                                    Contacts
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content text-muted">
                            <div class="tab-pane active" id="chats" role="tabpanel">
                                <div class="chat-room-list pt-3" data-simplebar>

                                    <div class="flex-grow-1 overflow-hidden">
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="flex-shrink-0 chat-user-img online user-own-img align-self-center me-3 ms-0">
                                                <img src="{{ asset('web/assets/images/users/avatar-2.jpg') }}"
                                                    class="rounded-circle avatar-xs" alt="">
                                                <span class="user-status"></span>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="text-truncate mb-0 fs-16"><a
                                                        class="text-reset username"
                                                        data-bs-toggle="offcanvas"
                                                        href="#userProfileCanvasExample"
                                                        aria-controls="userProfileCanvasExample">{{ $order->services->name_ar }}
                                                        #{{ $order->id }}</a>
                                                </h5>
                                                <p
                                                    class="text-truncate text-muted fs-14 mb-0 userStatus">
                                                    <small>Online</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="chat-message-list">

                                        <ul class="list-unstyled chat-list chat-user-list" id="userList">

                                        </ul>
                                    </div>

                                    

                                    <div class="chat-message-list">

                                        <ul class="list-unstyled chat-list chat-user-list mb-0" id="channelList">
                                        </ul>
                                    </div>
                                    <!-- End chat-message-list -->
                                </div>
                            </div>
                            <div class="tab-pane" id="contacts" role="tabpanel">
                                <div class="chat-room-list pt-3" data-simplebar>
                                    <div class="sort-contact">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end tab contact -->
                    </div> --}}
                    <!-- end chat leftsidebar -->
                    <!-- Start User chat -->
                    <div class="user-chat w-100 overflow-hidden">

                        <div class="chat-content d-lg-flex">
                            <!-- start chat conversation section -->
                            <div class="w-100 overflow-hidden position-relative">
                                <!-- conversation user -->
                                <div class="position-relative">
                                    <div class="position-relative" id="users-chat">
                                        <div class="p-3 user-chat-topbar">
                                            <div class="row align-items-center">
                                                <div class="col-sm-4 col-8">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 d-block d-lg-none me-3">
                                                            <a href="javascript: void(0);"
                                                                class="user-chat-remove fs-18 p-1"><i
                                                                    class="ri-arrow-left-s-line align-bottom"></i></a>
                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <div class="d-flex align-items-center">
                                                                <div
                                                                    class="flex-shrink-0 chat-user-img online user-own-img align-self-center me-3 ms-0">
                                                                    <img src="{{ asset('images/' . $order->services->image) }}"
                                                                        class="rounded-circle avatar-xs" alt="">
                                                                    <span class="user-status"></span>
                                                                </div>
                                                                <div class="flex-grow-1 overflow-hidden">
                                                                    <h5 class="text-truncate mb-0 fs-16"><a
                                                                            class="text-reset username"
                                                                            data-bs-toggle="offcanvas"
                                                                            href="#userProfileCanvasExample"
                                                                            aria-controls="userProfileCanvasExample">{{ $order->services->name_ar }}
                                                                            #{{ $order->id }}</a>
                                                                    </h5>
                                                                    <p
                                                                        class="text-truncate text-muted fs-14 mb-0 userStatus">
                                                                        <small>Online</small>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-8 col-4">
                                                    <ul class="list-inline user-chat-nav text-end mb-0">
                                                        <li class="list-inline-item m-0">
                                                            {{-- <div class="dropdown">
                                                                <button class="btn btn-ghost-secondary btn-icon"
                                                                    type="button" data-bs-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    <i data-feather="search" class="icon-sm"></i>
                                                                </button>
                                                                <div
                                                                    class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg">
                                                                    <div class="p-2">
                                                                        <div class="search-box">
                                                                            <input type="text"
                                                                                class="form-control bg-light border-light"
                                                                                placeholder="Search here..."
                                                                                onkeyup="searchMessages()"
                                                                                id="searchMessage">
                                                                            <i class="ri-search-2-line search-icon"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                        </li>

                                                        <li class="list-inline-item d-none d-lg-inline-block m-0">
                                                            {{-- <button type="button"
                                                                class="btn btn-ghost-secondary btn-icon"
                                                                data-bs-toggle="offcanvas"
                                                                data-bs-target="#userProfileCanvasExample"
                                                                aria-controls="userProfileCanvasExample">
                                                                <i data-feather="info" class="icon-sm"></i>
                                                            </button> --}}
                                                            <a href="{{ route('order.index') }}"
                                                                class="btn btn-secondary">الخروج من المحادثة</a>
                                                        </li>

                                                        <li class="list-inline-item m-0">
                                                            <div class="dropdown">
                                                                <a href="#"
                                                                    class="btn btn-danger {{ $order->status == 3 ? 'disabled' : '' }}"
                                                                    data-bs-toggle="modal" data-bs-target="#topmodal"
                                                                    data-order-id="{{ $order->id }}">
                                                                    {{ $order->status == 3 ? 'تم  انهاء المحادثه' : 'انهاء المحادثة' }}
                                                                </a>
                                                                {{-- start modal  --}}
                                                                <div id="topmodal" class="modal fade" tabindex="-1"
                                                                    aria-hidden="true" style="display: none;">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-body text-center p-5">
                                                                                <lord-icon
                                                                                    src="https://cdn.lordicon.com/pdwpcpva.json"
                                                                                    trigger="loop" state="in-reveal"
                                                                                    style="width:250px;height:250px">
                                                                                </lord-icon>
                                                                                <div class="mt-4">
                                                                                    <h4 class="mb-3">هل انت متاكد من غلق
                                                                                        المحادثة ؟</h4>
                                                                                    <p class="text-muted mb-4">فى حال غلق
                                                                                        المحادثة لايمكن الارسال مره اخري.
                                                                                    </p>
                                                                                    <div
                                                                                        class="hstack gap-2 justify-content-center">
                                                                                        <a href="javascript:void(0);"
                                                                                            class="btn btn-link link-success fw-medium"
                                                                                            data-bs-dismiss="modal"><i
                                                                                                class="ri-close-line me-1 align-middle"></i>
                                                                                            خروج</a>
                                                                                        <a href="javascript:void(0);"
                                                                                            id="delete-confirm"
                                                                                            class="btn btn-danger">غلق
                                                                                            المحادثة</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div><!-- /.modal-content -->
                                                                    </div><!-- /.modal-dialog -->
                                                                </div>
                                                                <!-- /.modal -->
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- end chat user head -->
                                        <div class="chat-conversation p-3 p-lg-4 " id="chat-conversation" data-simplebar>
                                            <div id="elmLoader">
                                                {{-- <div class="spinner-border text-primary avatar-sm" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div> --}}
                                            </div>
                                            <ul class="list-unstyled chat-conversation-list" id="users-conversation">
                                                @foreach ($messages as $data)
                                                    @if ($data->user_id != Auth()->user()->id)
                                                        <li class="chat-list left" id="chat-list-2">
                                                            <div class="conversation-list">
                                                                <div class="user-chat-content">
                                                                    <div class="ctext-wrap">
                                                                        <div class="ctext-wrap-content">
                                                                            <p class="mb-0 ctext-content">
                                                                                {{ $data->body }}</p>
                                                                        </div>
                                                                        <div
                                                                            class="dropdown align-self-start message-box-drop">
                                                                            <a class="dropdown-toggle" href="#"
                                                                                role="button" data-bs-toggle="dropdown"
                                                                                aria-haspopup="true" aria-expanded="false">
                                                                                <i class="ri-more-2-fill"></i>
                                                                            </a>
                                                                            <div class="dropdown-menu">
                                                                                <a class="dropdown-item reply-message"
                                                                                    href="#">
                                                                                    <i
                                                                                        class="ri-reply-line me-2 text-muted align-bottom"></i>Reply
                                                                                </a>
                                                                                <a class="dropdown-item" href="#">
                                                                                    <i
                                                                                        class="ri-share-line me-2 text-muted align-bottom"></i>Forward
                                                                                </a>
                                                                                <a class="dropdown-item copy-message"
                                                                                    href="#">
                                                                                    <i
                                                                                        class="ri-file-copy-line me-2 text-muted align-bottom"></i>Copy
                                                                                </a>
                                                                                <a class="dropdown-item" href="#">
                                                                                    <i
                                                                                        class="ri-bookmark-line me-2 text-muted align-bottom"></i>Bookmark
                                                                                </a>
                                                                                <a class="dropdown-item delete-item"
                                                                                    href="#">
                                                                                    <i
                                                                                        class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>Delete
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="conversation-name">
                                                                        <small
                                                                            class="text-muted time">{{ $data->created_at->format('g:i a') }}</small>
                                                                        <span class="text-success check-message-icon"><i
                                                                                class="bx bx-check"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @else
                                                        <li class="chat-list right" id="chat-list-2">
                                                            <div class="conversation-list">
                                                                <div class="user-chat-content">
                                                                    <div class="ctext-wrap">
                                                                        <div class="ctext-wrap-content">
                                                                            <p class="mb-0 ctext-content">
                                                                                {{ $data->body }}</p>
                                                                        </div>
                                                                        <div
                                                                            class="dropdown align-self-start message-box-drop">
                                                                            <a class="dropdown-toggle" href="#"
                                                                                role="button" data-bs-toggle="dropdown"
                                                                                aria-haspopup="true"
                                                                                aria-expanded="false">
                                                                                <i class="ri-more-2-fill"></i>
                                                                            </a>
                                                                            <div class="dropdown-menu">
                                                                                <a class="dropdown-item reply-message"
                                                                                    href="#">
                                                                                    <i
                                                                                        class="ri-reply-line me-2 text-muted align-bottom"></i>Reply
                                                                                </a>
                                                                                <a class="dropdown-item" href="#">
                                                                                    <i
                                                                                        class="ri-share-line me-2 text-muted align-bottom"></i>Forward
                                                                                </a>
                                                                                <a class="dropdown-item copy-message"
                                                                                    href="#">
                                                                                    <i
                                                                                        class="ri-file-copy-line me-2 text-muted align-bottom"></i>Copy
                                                                                </a>
                                                                                <a class="dropdown-item" href="#">
                                                                                    <i
                                                                                        class="ri-bookmark-line me-2 text-muted align-bottom"></i>Bookmark
                                                                                </a>
                                                                                <a class="dropdown-item delete-item"
                                                                                    href="#">
                                                                                    <i
                                                                                        class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>Delete
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="conversation-name">
                                                                        <small
                                                                            class="text-muted time">{{ $data->created_at->format('g:i a') }}</small>
                                                                        <span class="text-success check-message-icon"><i
                                                                                class="bx bx-check"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                            <!-- end chat-conversation-list -->
                                        </div>

                                    </div>

                                    <div class="position-relative" id="channel-chat">
                                        <div class="p-3 user-chat-topbar">
                                            <div class="row align-items-center">
                                                <div class="col-sm-4 col-8">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 d-block d-lg-none me-3">
                                                            <a href="javascript: void(0);"
                                                                class="user-chat-remove fs-18 p-1"><i
                                                                    class="ri-arrow-left-s-line align-bottom"></i></a>
                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <div class="d-flex align-items-center">
                                                                <div
                                                                    class="flex-shrink-0 chat-user-img online user-own-img align-self-center me-3 ms-0">
                                                                    <img src="{{ asset('web/assets/images/users/avatar-2.jpg') }}"
                                                                        class="rounded-circle avatar-xs" alt="">
                                                                </div>
                                                                <div class="flex-grow-1 overflow-hidden">
                                                                    <h5 class="text-truncate mb-0 fs-16"><a
                                                                            class="text-reset username"
                                                                            data-bs-toggle="offcanvas"
                                                                            href="#userProfileCanvasExample"
                                                                            aria-controls="userProfileCanvasExample">Lisa
                                                                            Parker</a></h5>
                                                                    <p
                                                                        class="text-truncate text-muted fs-14 mb-0 userStatus">
                                                                        <small>24 Members</small>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-8 col-4">
                                                    <ul class="list-inline user-chat-nav text-end mb-0">
                                                        <li class="list-inline-item m-0">
                                                            <div class="dropdown">
                                                                <button class="btn btn-ghost-secondary btn-icon"
                                                                    type="button" data-bs-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    <i data-feather="search" class="icon-sm"></i>
                                                                </button>
                                                                <div
                                                                    class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg">
                                                                    <div class="p-2">
                                                                        <div class="search-box">
                                                                            <input type="text"
                                                                                class="form-control bg-light border-light"
                                                                                placeholder="Search here..."
                                                                                onkeyup="searchMessages()"
                                                                                id="searchMessage">
                                                                            <i class="ri-search-2-line search-icon"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <li class="list-inline-item d-none d-lg-inline-block m-0">
                                                            <button type="button"
                                                                class="btn btn-ghost-secondary btn-icon"
                                                                data-bs-toggle="offcanvas"
                                                                data-bs-target="#userProfileCanvasExample"
                                                                aria-controls="userProfileCanvasExample">
                                                                <i data-feather="info" class="icon-sm"></i>
                                                            </button>
                                                        </li>

                                                        <li class="list-inline-item m-0">
                                                            <div class="dropdown">
                                                                <button class="btn btn-ghost-secondary btn-icon"
                                                                    type="button" data-bs-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    <i data-feather="more-vertical" class="icon-sm"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item d-block d-lg-none user-profile-show"
                                                                        href="#"><i
                                                                            class="ri-user-2-fill align-bottom text-muted me-2"></i>
                                                                        View Profile</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ri-inbox-archive-line align-bottom text-muted me-2"></i>
                                                                        Archive</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ri-mic-off-line align-bottom text-muted me-2"></i>
                                                                        Muted</a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ri-delete-bin-5-line align-bottom text-muted me-2"></i>
                                                                        Delete</a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- end chat user head -->
                                        <div class="chat-conversation p-3 p-lg-4" id="chat-conversation" data-simplebar>
                                            <ul class="list-unstyled chat-conversation-list" id="channel-conversation">
                                            </ul>
                                            <!-- end chat-conversation-list -->

                                        </div>
                                        <div class="alert alert-warning alert-dismissible copyclipboard-alert px-4 fade show "
                                            id="copyClipBoardChannel" role="alert">
                                            Message copied
                                        </div>
                                    </div>

                                    <!-- end chat-conversation -->

                                    <div class="chat-input-section p-3 p-lg-4">

                                        <form action="{{ route('send.message') }}" method="Post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row g-0 align-items-center">
                                                <input type="text" name="conversation_id"
                                                    value="{{ $conversations->first()->id }}" hidden>
                                                <div class="col">
                                                    <div class="chat-input-feedback">
                                                        Please Enter a Message
                                                    </div>
                                                    <input {{ $order->status == 3 ? 'disabled' : '' }} type="text"
                                                        class="form-control  bg-light border-light" id="chat-input"
                                                        placeholder="Type your message..." autocomplete="off"
                                                        name="body">
                                                </div>
                                                <div class="col-auto">
                                                    <div class="chat-input-links ms-2">
                                                        <div class="links-list-item">
                                                            <button {{ $order->status == 3 ? 'disabled' : '' }}
                                                                type="submit"
                                                                class="btn btn-success  waves-effect waves-light">
                                                                <i class="ri-send-plane-2-fill align-bottom"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="replyCard">
                                        <div class="card mb-0">
                                            <div class="card-body py-3">
                                                <div class="replymessage-block mb-0 d-flex align-items-start">
                                                    <div class="flex-grow-1">
                                                        <h5 class="conversation-name"></h5>
                                                        <p class="mb-0"></p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <button type="button" id="close_toggle"
                                                            class="btn btn-sm btn-link mt-n2 me-n3 fs-18">
                                                            <i class="bx bx-x align-middle"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end chat-wrapper -->

            </div>

        </div>
    </div>
    </div>
@endsection
@push('js')
    <!-- glightbox js -->
    <script src="{{ asset('web/assets/libs/glightbox/js/glightbox.min.js') }}"></script>

    <!-- fgEmojiPicker js -->
    <script src="{{ asset('web/assets/libs/fg-emoji-picker/fgEmojiPicker.js') }}"></script>

    <!-- chat init js -->
    <script src="{{ asset('web/assets/js/pages/chat.init.js') }}"></script>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Modal show event listener
            $('#topmodal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var id = button.data('order-id'); // Extract info from data-order-id attribute

                // Update the delete button href attribute
                var deleteUrl = '{{ route('chat.lock', ':id') }}'; // Use the route with a placeholder
                deleteUrl = deleteUrl.replace(':id', id); // Replace placeholder with actual ID
                $('#delete-confirm').attr('href', deleteUrl); // Set the href attribute
            });
        });
    </script>
@endpush
