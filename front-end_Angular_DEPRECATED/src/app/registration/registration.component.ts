import { Component } from '@angular/core';
import { AbstractControl, FormBuilder, FormGroup, Validators } from '@angular/forms';
import { MatSnackBar } from "@angular/material/snack-bar";
import { Router } from '@angular/router';
import { AuthService } from '../_services/auth.service';
import { User } from '../_models/user';

@Component({
  selector: 'app-registration',
  templateUrl: './registration.component.html',
  styleUrls: ['./registration.component.css']
})
export class RegistrationComponent {
  constructor(
    private fb: FormBuilder,
    private snackBar: MatSnackBar,
    private authService: AuthService,
    private router: Router
  ) { }

  isSuccessful = false;
  isSignUpFailed = false;
  // errorMessage = '';

  registrationForm = this.fb.group({
    name: ['', [Validators.required, Validators.minLength(3)]],
    email: ['', [Validators.required, Validators.pattern(/^[a-zA-Z][a-zA-Z\d\w.]{2,}@[a-zA-Z\d]{3,}\.[a-zA-Z]{2,}$/)]],
    password: ['', [Validators.required, Validators.pattern(/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/)]],
    confirmPassword: ['', [Validators.required]],
    phoneNo: ['', [Validators.required, Validators.pattern(/^[789]\d{9,9}$/)]]
  }, { validators: this.mustMatchValidator });

  get name() {
    return this.registrationForm.get("name");
  }
  get email() {
    return this.registrationForm.get("email");
  }
  get password() {
    return this.registrationForm.get("password");
  }
  get confirmPassword() {
    return this.registrationForm.get("confirmPassword");
  }
  get phoneNo() {
    return this.registrationForm.get("phoneNo");
  }

  mustMatchValidator(fg: AbstractControl): { [key: string]: boolean } | null {
    const passwordValue = fg.get("password")?.value;
    const confirmPasswordValue = fg.get("confirmPassword")?.value;
    console.log(passwordValue + '\n' + confirmPasswordValue);
    if (passwordValue !== confirmPasswordValue) {
      console.log("mustMatch true");
      fg.get('confirmPassword')?.setErrors({ mustMatch: true });
      return { mustMatch: true }
    }
    return null;
  }

  onSubmit(registrationForm: FormGroup): void {
    if (registrationForm.valid) {
      const user: User = registrationForm.value;
      this.authService.register(user).subscribe({
        next: data => {
          console.log(data);
          this.isSuccessful = true;
          this.isSignUpFailed = false;
          this.router.navigate(['/login']);
          this.snackBar.open("Congrats!!! You are registered with us.", "Registerd", {
            duration: 7000,
            panelClass: ['mat-toolbar', 'mat-primary']
          });
        },
        error: err => {
          console.log(err);
          this.isSignUpFailed = true;
          this.snackBar.open(err.error.message, "Failed", {
            panelClass: ['mat-toolbar', 'mat-primary']
          });
        }
      });
    }
  }

  // resetForm() {
  //   this.registrationForm.reset();
  //   Object.keys(this.registrationForm.controls).forEach(key => {
  //     this.registrationForm.get(key)?.setErrors(null);
  //   });
  // }
}
