import { Component, Input, OnInit } from '@angular/core';
import { CommentService } from './comment.service';
import { Comment } from '../types';
const initialComment: Comment = {
  id: 0,
  author: '',
  content: '',
  productId: 0,
};
@Component({
  selector: 'app-comment',
  templateUrl: './comment.component.html',
  styleUrls: ['./comment.component.css'],
})
export class CommentComponent implements OnInit {
  comments!: Comment[];
  selectedComment: Comment = initialComment;
  message?: string;
  msgType!: string;
  @Input() productId!: number;

  constructor(private commentService: CommentService) {}

  ngOnInit(): void {
    this.getComments();
    // this.message = 'You are good';
    this.msgType = 'danger';
  }

  getComments(): void {
    this.commentService
      .getComments(this.productId)
      .subscribe((comments) => (this.comments = comments));
  }

  editComment(comment: Comment): void {
    this.selectedComment = comment;
  }
  cancelComment(): void {
    this.selectedComment = initialComment;
  }
  deleteComment(comment: Comment): void {
    this.commentService.deleteComment(comment.id).subscribe(
      () => {
        this.comments = this.comments.filter((c) => c !== comment);
        this.selectedComment = initialComment;
        this.message = 'Comment deleted successfully';
        this.msgType = 'success';
      },
      (error) => {
        this.message = error?.error?.error;
        this.msgType = 'danger';
      }
    );
  }

  saveComment(comment: Comment): void {
    if (this.selectedComment != initialComment) {
      this.commentService.updateComment(comment).subscribe(
        (updatedComment) => {
          const index = this.comments.findIndex(
            (c) => c.id === updatedComment.id
          );
          this.comments[index] = updatedComment;
          this.selectedComment = initialComment;
          this.message = 'Comment updated successfully';
          this.msgType = 'success';
        },
        (error) => {
          this.message = error?.error?.error;
          this.msgType = 'danger';
        }
      );
    } else {
      comment.productId = this.productId;
      this.commentService.addComment(comment).subscribe(
        (newComment) => {
          this.comments.push(newComment);
          this.selectedComment = initialComment;
          this.message = 'Comment added successfully';
          this.msgType = 'success';
        },
        (error) => {
          this.message = error?.error?.error;
          this.msgType = 'danger';
        }
      );
    }
  }
}
