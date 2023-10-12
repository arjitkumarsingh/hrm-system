import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { User } from '../_models/user';
import { Observable, map } from 'rxjs';

const httpOptions = {
  headers: new HttpHeaders({ 'Content-Type': 'application/json' })
};

const LOGIN_API = "http://localhost/projects/hrm-system/back-end/get_user.php";
const REGISTER_API = "http://localhost/projects/hrm-system/back-end/save_user.php";
const USERS_API = "http://localhost/projects/hrm-system/back-end/get_users.php";

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor(private http: HttpClient) { }

  login(user: User): Observable<any | null> {
    return this.http.post(LOGIN_API, user, httpOptions);
  }

  register(user: User): Observable<any> {
    return this.http.post(REGISTER_API, user, httpOptions);
  }

  getAllUsers(): Observable<User[]> {
    return this.http.get<User[]>(USERS_API, httpOptions);
  }
}
