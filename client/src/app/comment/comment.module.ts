import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { CommentFormComponent } from '../comment-form/comment-form.component';
import { CommentComponent } from './comment.component';
import { FormsModule } from '@angular/forms';

@NgModule({
  declarations: [CommentFormComponent, CommentComponent],
  imports: [CommonModule, FormsModule],
  exports: [CommentComponent],
})
export class CommentModule {}
