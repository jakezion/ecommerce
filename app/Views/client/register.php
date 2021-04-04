<?= $this->extend('simple_layout'); ?>

<?= $this->section('content'); ?>
    <div class="col-sm-8 col-md-6 col-lg-5 mx-auto">
        <div class="card shadow-sm card-register my-5">
            <div class="card-body">
                <h2 class="card-title text-center"><?= esc($title); ?></h2>
                <div id="form"></div>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
    <script src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>
    <script type="text/babel">

        class MultiForm extends React.Component {
            constructor(props) {
                super(props);
                this.state = {
                    username:
                        '',
                    phone: '',
                    email: '',
                    password: '',
                    usernameError: '',
                    phoneError: '',
                    emailError: '',
                    passwordError: '',
                };

                this.handleUsername = this.handleUsername.bind(this);
                this.handlePhone = this.handlePhone.bind(this);
                this.handleEmail = this.handleEmail.bind(this);
                this.handlePassword = this.handlePassword.bind(this);
                this.handleSubmit = this.handleSubmit.bind(this);


            }


            handleUsername(event) {
                this.setState({username: event.target.value}, () => {
                    this.validateUsername();
                });
            }


            handlePhone(event) {
                this.setState({phone: event.target.value}, () => {
                    this.validatePhoneNumber();
                });
            }


            handleEmail(event) {
                this.setState({email: event.target.value}, () => {
                    this.validateEmailAddress();
                });
            }

            handlePassword(event) {
                this.setState({password: event.target.value});
                // let password = this.state.password;
            }

            validateUsername() {
                let username = this.state.username;
                let symbols = new RegExp(/[^a - zA - Z0 - 9\s]/);
                //let symbols = new RegExp(/^[a-zA-Z0-9!@#$%^&*)(+=._-]*$/);
                if (symbols.test(username)) {
                    this.setState({nameError: 'Your username is invalid'});
                    //   <style>.invalid{text-color: red;}</style>
                } else {
                    this.setState({nameError: ''});
                    //   <style>.invalid{text-color: black;}</style>
                }
            }

            validatePhoneNumber() {
                let phone = this.state.phone;
                if (phone.length < 10) {
                    this.setState({
                        phoneError: 'Phone must be 10 digits.'
                    });
                } else if (phone.length > 10) {
                    this.setState({
                        phoneError: 'Phone must be 10 digits.'
                    });
                } else if (isNaN(phone)) {
                    this.setState({
                        phoneError: 'Phone must be numeric.'
                    });
                } else {
                    this.setState({
                        phoneError: ''
                    });
                }
            }

            validateEmailAddress() {
                let email = this.state.email;
                let format = new RegExp(/[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,64}/);
                if (format.test(email)) {
                    this.setState({emailError: ''});
                } else {
                    this.setState({emailError: 'Email address isn\'t valid'});
                }
            }

            validatePassword() {
                let password = this.state.password;
            }

            handleSubmit(event) {


                // $(document).ready(function () {
                //     event.preventDefault();
                //
                //     $.ajax({
                //         url: 'handler.php',
                //         type: 'POST',
                //         data: {
                //             'username': this.state.username,
                //             'phone': this.state.phone,
                //             'email': this.state.email
                //         },
                //         cache: false,
                //         success: function (data) {
                //             this.setState({
                //                 type: 'success',
                //                 message: 'Form received and will be processed'
                //             });
                //             // $('.form-group').slideUp();
                //             // $('.form-group').after(this.state.contactMessage);
                //             console.log('success', data);
                //         }.bind(this),
                //         error: function (xhr, status, err) {
                //             console.log(xhr, status);
                //             console.log(err);
                //             this.setState({
                //                 type: 'danger',
                //                 message: 'Sorry the form encountered an error'
                //             });
                //             console.log(this.state.username + this.state.phone + this.state.email + 'fail');
                //         }.bind(this)
                //     });
                // });
                alert(this.state.username + this.state.phone + this.state.email + this.state.password);
                event.preventDefault();
            }

            //TODO: FINSIH FORM VALUES
            render() {
                return (
                    <form onSubmit={
                        this.handleSubmit} method="post" encType="multipart/form-data">
                        <div className="form-group">
                            <label htmlFor="username"> Username:</label>
                            <input
                                name="username"
                                type="text"
                                className={
                                    `form-control ` + `${this.state.nameError ? 'is-invalid' : ''}`}
                                value={
                                    this.state.username}
                                id="username"
                                onChange={
                                    this.handleUsername}
                                onBlur={
                                    this.validateUsername}
                                placeholder="Username"
                            />
                            <div className='invalid-feedback'>{
                                this.state.nameError}</div>
                        </div>
                        <div className="form-group">
                            <label htmlFor="phone"> Phone Number:</label>
                            <input
                                name="phone"
                                type="text"

                                value={
                                    this.state.phone}
                                className={
                                    `form-control ` + `${this.state.phoneError ? 'is-invalid' : ''}`}
                                id="phone"
                                onChange={
                                    this.handlePhone}
                                onBlur={
                                    this.validatePhoneNumber}
                                placeholder="Phone Number"
                            />
                            <div className='invalid-feedback'>{
                                this.state.phoneError}</div>
                        </div>
                        <div className="form-group">
                            <label htmlFor="email"> Email Address:</label>
                            <input
                                name="email"
                                type="email"
                                value={
                                    this.state.email}
                                className={
                                    `form-control ` + `${this.state.emailError ? 'is-invalid' : ''}`}
                                id="email"
                                onChange={
                                    this.handleEmail}
                                onBlur={
                                    this.validateEmailAddress}
                                placeholder="name@example.co.uk"
                            />
                            <div className='invalid-feedback'>{
                                this.state.emailError}</div>
                        </div>
                        <div className="form-group">
                            <label htmlFor="password"> Password:</label>
                            <input
                                name="password"
                                type="password"
                                className='form-control'
                                value={
                                    this.state.password}
                                id="password"
                                onChange={
                                    this.handlePassword}
                                onBlur={
                                    this.validatePassword}
                                placeholder="Password"
                            />
                        </div>
                        <div className='invalid-feedback'>{
                            this.state.passwordError}</div>
                        <button type='submit' className='btn btn-primary btn-block'> Submit</button>
                    </form>
                );
            }
        }

        ReactDOM.render(
            <MultiForm/>,
            document.getElementById('form')
        );

    </script>


<?= $this->endSection(); ?>