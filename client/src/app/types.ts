export interface Comment {
  id?: number;
  content: string;
  author: string;
  createdAt?: string;
  updatedAt?: string;
  productId: number;
}

export interface Product {
  id: number;
  title: string;
  description: string;
  price: number;
  image: string;
  comments: number;
}

export const API_URL = 'http://www.wiu.edu/users/liu100/productlist';
