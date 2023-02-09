import {
  Component,
  Input,
  OnChanges,
  OnInit,
  SimpleChanges,
} from '@angular/core';

@Component({
  selector: 'app-alert',
  templateUrl: './alert.component.html',
  styleUrls: ['./alert.component.css'],
})
export class AlertComponent implements OnInit, OnChanges {
  @Input() type!: string;
  @Input() message?: string;

  ngOnInit() {
    setTimeout(() => {
      this.message = undefined;
    }, 3000);
  }
  ngOnChanges(): void {
    console.log('#########');
    setTimeout(() => {
      this.message = undefined;
    }, 3000);
  }
}
