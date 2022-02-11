import React from 'react';
import ReactDOM from 'react-dom';
import '../../css/styles.css';

import {BrowserRouter as Router, Switch, Route} from 'react-router-dom';


import Home from './Home';
import Blog from './Blog';
import Portfolio from './Portfolio';
import Contact from './Contact';
import Single from './Single';
import Category from './Category';
import Categories from './Categories';



function App() {

 

  return (
    <div className="App">
        <Router basename="/">
        <Switch>
          <Route path="(/|/home)/" exact component={Home}/>
          <Route path="/portfolio" exact component={Portfolio}/>
          <Route path="/posts" exact component={Blog}/>
          <Route path="/categories" exact component={Categories}/>
          <Route path="/contact" exact component={Contact}/>

          {/* <Route path="/search/:query" component={SearchResults}/> */}

          <Route path="/category/:id" exact component={Category}/>
          <Route path="/post/:id" component={Single}/>
         </Switch>
        </Router>
    </div>
  );
}

export default App;
if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}
