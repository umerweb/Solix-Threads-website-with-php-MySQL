<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login To Solix</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="partials/handle-login.php" >
                    <div class="form-group">
                        <label for="email-login">Email address</label>
                        <input type="email" class="form-control" id="email-login" aria-describedby="emailHelp" name="email-login" placeholder="Enter your Email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="password-login">Password</label>
                        <input type="password" class="form-control" id="password-login" name="password-login"  placeholder="Enter Your Password">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="Check-login">
                        <label class="form-check-label" for="Check-login">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
          
        </div>
    </div>
</div>