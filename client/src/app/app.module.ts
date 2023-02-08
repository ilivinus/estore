import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { ProductComponent } from './product/product.component';
import { HttpClientModule } from '@angular/common/http';
import { ProductDetailModule } from './product-detail/product-detail.module';

@NgModule({
  declarations: [AppComponent, ProductComponent],
  imports: [
    HttpClientModule,
    BrowserModule,
    AppRoutingModule,
    ProductDetailModule,
  ],
  providers: [],
  bootstrap: [AppComponent],
})
export class AppModule {}
