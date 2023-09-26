import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { MatSnackBar } from '@angular/material/snack-bar';
import { AuthService } from '../_services/auth.service';
import { Router } from '@angular/router';
import { User } from '../_models/user';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {
  constructor(private fb: FormBuilder, private snackBar: MatSnackBar, private authService: AuthService,
    private router: Router) { }

  isLoggedIn = false;
  isLoginFailed = false;
  errorMessage = '';

  loginForm = this.fb.group({
    email: ['', [Validators.required, Validators.email]],
    password: ['', [Validators.required, Validators.pattern(/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/)]],
  });

  get email() {
    return this.loginForm.get("email");
  }
  get password() {
    return this.loginForm.get("password");
  }

  // ngOnInit(): void {
  //   if (!!this.tokenStorage.getToken()) {
  //     this.isLoggedIn = true;
  //   }
  // }

  onSubmit(loginForm: FormGroup): void {
    if (loginForm.valid) {
      const user: User = loginForm.value;
      this.authService.login(user).subscribe({
        next: data => {
          // this.tokenStorage.saveToken(data.token);
          // this.tokenStorage.saveUser(data);
          console.log(data);
          this.isLoginFailed = false;
          this.isLoggedIn = true;

          // this.authService.getProfile(data.id).subscribe({
          //   next: response => {
          //     console.log(response);
          //     if (!response.image) {
          //       // const imaage = "assets/user.png"
          //       response.image = "assets/user.png"
          //     }
          //     this.tokenStorage.saveUser(response);
          //     this.dataSharingService.isLoggedIn.next(true);
          //   },
          //   error: error => {
          //     console.log(error);
          //     this.dataSharingService.isLoggedIn.next(true);
          //   }
          // });
          this.router.navigate(['/dashboard']);
          this.snackBar.open("Logged in", 'OK', {
            duration: 5000,
            panelClass: ['mat-toolbar', 'mat-primary']
          });
        },
        error: err => {
          console.log(err);
          this.errorMessage = err.error.message;
          this.isLoginFailed = true;
          this.snackBar.open(this.errorMessage, "Failed", {
            duration: 5000,
          });
        }
      });
    }
  }
}
