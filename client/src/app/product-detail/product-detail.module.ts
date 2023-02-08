import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ProductDetailComponent } from './product-detail.component';

import { CommentModule } from '../comment/comment.module';
import { CommentComponent } from '../comment/comment.component';

@NgModule({
  declarations: [ProductDetailComponent],
  imports: [CommonModule, CommentModule],
  exports: [ProductDetailComponent],
})
export class ProductDetailModule {}
