import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Comment } from '../types';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class CommentService {
  private API_URL = 'http://localhost:8000/comments.php';

  constructor(private http: HttpClient) {}

  getComments(productId: number): Observable<Comment[]> {
    return this.http.get<Comment[]>(`${this.API_URL}?id=${productId}`);
  }

  getCommentById(id: number): Observable<Comment> {
    return this.http.get<Comment>(`${this.API_URL}?id=${id}`);
  }

  addComment(comment: Comment): Observable<Comment> {
    return this.http.post<Comment>(this.API_URL, comment);
  }

  updateComment(comment: Comment): Observable<Comment> {
    return this.http.put<Comment>(`${this.API_URL}?id=${comment.id}`, comment);
  }

  deleteComment(id?: number): Observable<Comment> {
    return this.http.delete<Comment>(`${this.API_URL}?id=${id}`);
  }
}
