<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Sign Up to Solix</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="partials/handle-signup.php">
                <div class="form-group">
                        <label for="name-signup">Name</label>
                        <input type="text" class="form-control" id="name-signup"  name="name-signup" placeholder="Enter your Name">
                       
                    </div>
                    <div class="form-group">
                        <label for="email-signup">Email address</label>
                        <input type="email" class="form-control" id="email-signup" aria-describedby="emailHelp" name="email-signup" placeholder="Enter your Email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="password-signup">Password</label>
                        <input type="password" class="form-control" id="password-signup" name="password-signup" placeholder="Enter Your Password">
                    </div>
                    <div class="form-group">
                        <label for="cpassword-signup">Confirm Password</label>
                        <input type="password" class="form-control" id="cpassword-signup" name="cpassword-signup" placeholder="Re-Enter your password">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="Check-signup">
                        <label class="form-check-label" for="Check-signup">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Signup</button>
                </form>
            </div>
           
        </div>
    </div>
</div>