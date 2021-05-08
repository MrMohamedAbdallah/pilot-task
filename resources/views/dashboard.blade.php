<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>
        
    {{-- BEGIN HEADER --}}
    <header class="header">
        <div class="header__content">
            <span class="header__text">{{ Auth::user()->name }}</span>
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a class="header__text" href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log out') }}
            </a>
            </form>
        </div>
    </header>
    {{-- END HEADER --}}

    @if(Session::has('success'))
    <div class="alert">
        {{ Session::get('success') }}
    </div>
    @endif

    {{-- BEGIN PAGE CONTAINER --}}
    <div class="page__container">
        <h1 class="page__title">Profile Details</h1>

        <form method="POST" action="{{ route('dashboard.update') }}" enctype="multipart/form-data">
            @csrf

            {{-- BEGIN FORM GROUP --}}
            <div class="form__group">
                 <label for="profile_pic">
                    <span class="form__label">Profile Image</span>
                    {{-- BEGIN PROFILE PICTURE --}}
                    <div class="form__profile-pic">
                        <input type="file" name="profile_pic" id="profile_pic" accept="image/*" style="display: none;">
                        <div class="form__profile-pic__circle" @if($user->profile_pic) style="border: none;" @endif>
                            @if($user->profile_pic)
                            <img 
                                src="{{ Storage::url($user->profile_pic) }}"
                                alt="{{ $user->name }}"
                                class="form__profile-pic__img">
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="75" height="75" viewBox="0 0 24 24" fill="none" stroke="#b2b2b2" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            @endif
                        </div>
                        <span class="form__profile-pic__text">
                            Upload a profile image
                            <br>
                            <small>This image will sometimes be used instead of your name</small>
                            <br>
                            <small id="profile_pic-value"></small>
                        </span>
                    </div>
                </label>
                <div>
                    
                @if($user->profile_pic)
                <label for="delete_pic">
                    <input type="checkbox" name="delete_pic" id="delete_pic" class="remove_pic">
                    <span>
                        &times; Remove Image
                    </span>
                </label>
                @endif

                </div>
                @error('profile_pic')
                <span class="form__msg">{{ $message }}</span>
                @endif
                {{-- END PROFILE PICTURE --}}
            </div>
            {{-- BEGIN FORM GROUP --}}

            <hr>


            {{-- BEGIN FORM ROW --}}
            <div class="form__row">
                {{-- BEGIN FORM GROUP --}}
                <div class="form__group">
                    <label class="form__label" for="name">Full Name</label>
                    <input 
                    type="text" 
                    name="name" 
                    id="name"
                    value="{{ old('name') ?? $user->name }}"
                    class="form__input @error('name') form__input--invalid @endif">
                    
                    @error('name')
                    <span class="form__msg">{{ $message }}</span>
                    @endif
                </div>
                {{-- EDN FORM GROUP --}}
                {{-- BEGIN FORM GROUP --}}
                <div class="form__group">
                    <label class="form__label" for="email">Email</label>
                    <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') ?? $user->email }}"
                    class="form__input @error('email') form__input--invalid @endif">

                    @error('email')
                    <span class="form__msg">{{ $message }}</span>
                    @endif
                </div>
                {{-- EDN FORM GROUP --}}
                {{-- BEGIN FORM GROUP --}}
                <div class="form__group">
                    <label class="form__label" for="phone">Phone</label>
                    <input
                    type="text"
                    name="phone"
                    id="phone"
                    value="{{ old('phone') ?? $user->phone }}"
                    class="form__input @error('phone') form__input--invalid @endif">
                    
                    @error('phone')
                    <span class="form__msg">{{ $message }}</span>
                    @endif
                </div>
                {{-- EDN FORM GROUP --}}
                {{-- BEGIN FORM GROUP --}}
                <div class="form__group">
                    <label class="form__label" for="job_title">Jog Title</label>
                    <input
                    type="text"
                    name="job_title"
                    id="job_title"
                    value="{{ old('job_title') ?? $user->job_title }}"
                    class="form__input @error('job_title') form__input--invalid @endif">
                    
                    @error('job_title')
                    <span class="form__msg">{{ $message }}</span>
                    @endif
                </div>
                {{-- EDN FORM GROUP --}}
            </div>
            {{-- END FORM ROW --}}

            <hr>

            <h3 class="form__title">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                <span>
                    CHANGE PASSWORD
                </span>
            </h3>

            {{-- BEGIN FORM ROW --}}
            <div class="form__row">
                {{-- BEGIN FORM GROUP --}}
                <div class="form__group">
                    <label class="form__label" for="password">New Password</label>
                    <input
                    type="password"
                    name="password"
                    id="password"
                    class="form__input @error('password') form__input--invalid @endif">
                    
                    @error('password')
                    <span class="form__msg">{{ $message }}</span>
                    @endif
                </div>
                {{-- EDN FORM GROUP --}}
                {{-- BEGIN FORM GROUP --}}
                <div class="form__group">
                    <label class="form__label" for="password_confirmation">Confirm Password</label>
                    <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="form__input @error('password_confirmation') form__input--invalid @endif">
                    
                    @error('password_confirmation')
                    <span class="form__msg">{{ $message }}</span>
                    @endif
                </div>
                {{-- EDN FORM GROUP --}}
            </div>
            {{-- END FORM ROW --}}

            <hr>

            <div class="form__footer">
                <button type="submit" class="form__submit">Save</button>
            </div>

        </form>
        
    </div>
    {{-- END PAGE CONTAINER --}}

    <script>
        // Show profile picture file name
        let fileValueElement = document.querySelector('#profile_pic-value');
        document.querySelector('#profile_pic').addEventListener('change', function(){
            if(this.value){
                let paths = this.value.split('/');
                if(paths.length <= 1)
                    paths = this.value.split('\\');

                let fileName = paths[paths.length - 1];
                fileValueElement.innerText = 'Image: ' + fileName;
            }
            else
                fileValueElement.innerText = ''
        })
    </script>

</body>

</html>