import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { RegistrationComponent } from './registration/registration.component';
import { LoginComponent } from './login/login.component';
import { DashboardComponent } from './dashboard/dashboard.component';

const routes: Routes = [
  // { path: 'home', component: HomeComponent },
  {path: "register", component: RegistrationComponent},
  {path: "login", component: LoginComponent},
  { path: 'dashboard', component: DashboardComponent},
  // { path: 'dashboard/:id', component: BoardComponent },
  // { path: 'reset-password', component: ResetPasswordComponent },
  // { path: 'profile', component: UserProfileComponent },
  // { path: "", redirectTo: "home", pathMatch: "full" },
  // { path: '**', component: NotFoundComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
