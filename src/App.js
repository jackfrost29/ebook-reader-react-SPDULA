// import logo from './logo.svg';
import './App.css';
import EbookReader from './components/ebookReader';

function list_images(){
  var f1 = '1'
  var f2 = '2'
  var f3 = '3'
  var f4 = '4'
  var f5 = '5'
  return ([f1, f2, f3, f4, f5])
}

function App() {
  var x = list_images()
  return (
    <div>
      <div style={{height: "70px", borderBottom: "1px solid #ebebeb"}} />
      <EbookReader pages={x} page_no={1}/>
      <div style={{height: "500px", backgroundColor: "red"}}></div>
    </div>
  );
}

export default App;


/*
<div className="App">
      <header className="App-header">
        <img src={logo} className="App-logo" alt="logo" />
        <p>
          Edit <code>src/App.js</code> and save to reload.
        </p>
        <a
          className="App-link"
          href="https://reactjs.org"
          target="_blank"
          rel="noopener noreferrer"
        >
          Learn React
        </a>
      </header>
    </div>
*/