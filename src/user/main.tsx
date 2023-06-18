import React from 'react';
import ReactDOM from 'react-dom/client';
import App from '../user/App';
import "./main.scss";


const root = ReactDOM.createRoot(document.getElementById("liilab_current_user_info") as HTMLElement);
const attributesData = document.getElementById("liilab_current_user_info")?.getAttribute("liilab_current_user_info");

const array = JSON.parse(attributesData || '{}');


root.render(
  <React.StrictMode>
    <App {...array} />
  </React.StrictMode>
);

