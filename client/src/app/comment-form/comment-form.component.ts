import { Component, EventEmitter, Input, Output } from '@angular/core';
import { Comment } from '../types';
@Component({
  selector: 'app-comment-form',
  templateUrl: './comment-form.component.html',
  styleUrls: ['./comment-form.component.css'],
})
export class CommentFormComponent {
  @Input() comment!: Comment;
  @Output() commentSaved = new EventEmitter<Comment>();
  @Output() commentCancelled = new EventEmitter();

  onSave(): void {
    this.commentSaved.emit(this.comment);
  }

  onCancel(): void {
    this.commentCancelled.emit();
  }
}
