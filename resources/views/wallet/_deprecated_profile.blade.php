@extends('wallet.index')
@section('content')


            <div class="wallet-box-scroll">
    <div class="wallet-bradcrumb">
        <h2><i class="fas fa-user"></i>{{trans('main.profile')}}</h2>
    </div>
    <div class="profile-page-area clearfix">
        <div class="profile-page-area-main">
            <div class="profile-information">
                <div class="editprofile-images">
                    <div class="edit-images">
                        <span class="edit-label"><i class="fas fa-camera"></i></span>
                    </div>
                </div>
            </div>
            <div class="profile-information-right">
                <div class="profile-information-box">
                    <div class="theme-input-box">
                        <label>First Name</label>
                        <input type="text" name="" value="Mithila" class="theme-input">
                    </div>
                    <div class="theme-input-box">
                        <label>Last Name</label>
                        <input type="text" name="" value="Mac" class="theme-input">
                    </div>
                    <div class="theme-input-box">
                        <label>Email</label>
                        <input type="email" name="" value="mithilamac@gmail.com" class="theme-input">
                    </div>
                    <div class="theme-input-box">
                        <label>Phone</label>
                        <input type="" name="" value="+91 1234 567 890" class="theme-input">
                    </div>
                    <div class="profile-btn">
                        <button class="theme-btn">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-reset-password">
            <div class="profile-information-box">
                <h2 class="dashboard-title">Reset Password</h2>
                <div class="theme-input-box">
                    <label>Email</label>
                    <input type="email" name="" class="theme-input">
                </div>
                <div class="theme-input-box">
                    <label>Old Password</label>
                    <input type="Password" name="" class="theme-input">
                </div>
                <div class="theme-input-box">
                    <label>New Password</label>
                    <input type="Password" name="" class="theme-input">
                </div>
                <div class="theme-input-box">
                    <label>Confirm Password</label>
                    <input type="Password" name="" class="theme-input">
                </div>
                <div class="profile-btn">
                    <button class="theme-btn">Update</button>
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

@endsection
