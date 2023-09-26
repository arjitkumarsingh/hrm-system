import { DataSource } from '@angular/cdk/collections';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from '../_services/auth.service';
import { User } from '../_models/user';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {
  constructor(private router: Router, private authService: AuthService) {}

  displayedColumns: string[] = ['id', 'name', 'email', 'password', 'phone_number', 'salary', 'role'];
  dataSource: User[] = [];

  // dataSource = new ExampleDataSource(this.dataToDisplay);

  ngOnInit(): void {
    this.authService.getAllUsers().subscribe({
      next: data => {
        console.log(data);
        this.dataSource = data;
      },
      error: err => {
        console.error(err);
      }
    });
  }
  addData() {
    // const randomElementIndex = Math.floor(Math.random() * ELEMENT_DATA.length);
    // this.dataToDisplay = [...this.dataToDisplay, ELEMENT_DATA[randomElementIndex]];
    // this.dataSource.setData(this.dataToDisplay);
  }

  removeData() {
    // this.dataToDisplay = this.dataToDisplay.slice(0, -1);
    // this.dataSource.setData(this.dataToDisplay);
  }
}

// class ExampleDataSource extends DataSource<PeriodicElement> {
  // private _dataStream = new ReplaySubject<PeriodicElement[]>();

  // constructor(initialData: PeriodicElement[]) {
    // super();
    // this.setData(initialData);
  // }

  // connect(): Observable<PeriodicElement[]> {
    // return this._dataStream;
  // }

  // disconnect() { }

  // setData(data: PeriodicElement[]) {
    // this._dataStream.next(data);
  // }
// }