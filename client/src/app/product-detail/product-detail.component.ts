import { Location } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { map, Observable } from 'rxjs';
import { CommentComponent } from '../comment/comment.component';
import { Product } from '../types';

@Component({
  selector: 'app-product-detail',
  templateUrl: './product-detail.component.html',
  styleUrls: ['./product-detail.component.css'],
})
export class ProductDetailComponent implements OnInit {
  productId!: number;
  product!: Product;

  constructor(private route: ActivatedRoute, private _location: Location) {}

  ngOnInit(): void {
    this.route.paramMap
      .pipe(map(() => window.history.state))
      .subscribe((data) => {
        this.product = data;
      });
    this.getProduct();
  }
  getProduct() {
    const id = Number(this.route.snapshot.paramMap.get('id'));
    this.productId = id;
  }
  backClicked() {
    this._location.back();
  }
}
