import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-product',
  templateUrl: './product.component.html',
  styleUrls: ['./product.component.css'],
})
export class ProductComponent implements OnInit {
  products: any[] = [];
  page = 1;
  noMoreProducts = false;

  constructor(private http: HttpClient) {}

  ngOnInit(): void {
    this.loadMore();
  }

  loadMore() {
    this.http
      .get(`http://localhost:8000/product.php?page=${this.page}`)
      .subscribe((res) => {
        this.products = this.products.concat(res);

        if (((res as []) ?? []).length === 0) {
          this.noMoreProducts = true;
        }
        this.page++;
      });
  }
}
