import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { API_URL, Comment } from '../types';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class CommentService {
  private url = `${API_URL}/comments.php`;

  constructor(private http: HttpClient) {}

  getComments(productId: number): Observable<Comment[]> {
    return this.http.get<Comment[]>(`${this.url}?id=${productId}`);
  }

  getCommentById(id: number): Observable<Comment> {
    return this.http.get<Comment>(`${this.url}?id=${id}`);
  }

  addComment(comment: Comment): Observable<Comment> {
    return this.http.post<Comment>(this.url, comment);
  }

  updateComment(comment: Comment): Observable<Comment> {
    return this.http.post<Comment>(
      `${this.url}?id=${comment.id}&method=POST`,
      comment
    );
  }

  deleteComment(id?: number): Observable<Comment> {
    return this.http.get<Comment>(`${this.url}?id=${id}&method=DELETE`);
  }
}
