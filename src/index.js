import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import './ebookReader.css'
import reportWebVitals from './reportWebVitals';
import EbookReader from './components/ebookReader';

const root = ReactDOM.createRoot(document.getElementById('book-reader-root'));
root.render(
  <React.StrictMode>
    <EbookReader />
  </React.StrictMode>
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
