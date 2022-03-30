import React, {useState, useEffect} from 'react'
import Header from './partials/Header';
import Footer from './partials/Footer';
import Search from './partials/Search';
import Sidebar from './partials/Sidebar';
import ReactHtmlParser from 'react-html-parser'; 

import { css } from "@emotion/core";
import ClipLoader from "react-spinners/ClipLoader";
import { Link } from 'react-router-dom';

export default function Category(props) {

    // search state
    const [searchDisplay, setSearchDisplay] = useState(false);
    const setDisplay = (input) => setSearchDisplay(input);

    // abort controller
    var controller = new AbortController();
    var signal = controller.signal;

    // post state
    const [state, setState] = useState({});
    const [loading, setLoading] = useState(true);

    const fetchItem = async () => { await fetch('/api/category/' + props.match.params.id, {
        method: "GET",
        signal: signal,
        headers : { 
          'Content-Type': 'text/html',
          'Accept': 'text/html'
       }}).then(async(response) => {
        const data = await response.json();    
        await setState(data);
        setLoading(false);
        })
    }

    useEffect(() => {
        if (loading) {fetchItem()}
        return () => {
            controller.abort();
        };
    });

    useEffect(() => {
        if(state.post){
            if (props.match.params.id !== state.post.slug) {
                setLoading(true);
            }
        }
    });


    

    return (
        <div className="main-container">
            <Header />

            <main>
            <Search currentId={props.match.params.id} display={searchDisplay} setDisplay={setDisplay}/>
            
            {searchDisplay ? null : 
                <div className="container">
                {loading ? <div className="spinner"><ClipLoader /></div> :
                        <div className="post">
                            <img className="post_thumbnail" src={state.category.image} alt={state.category.title}></img>
                            <div className="post_container">
                                <div className="timestamp">{state.category.created_at}</div>
                                <h1>{state.category.title}</h1>
                                {ReactHtmlParser(state.category.body)}

                                <br /><br />
                                <hr />

                                {/* if there are no posts in this category, display an empty div */}
                                {/* Else, we print out a list of posts with links to them */}
                                {state.posts_in_category && state.posts_in_category.length === 0 ? <div></div> 
                                : <div>
                                    <br />
                                    <em>List of related posts:</em>
                                    <ul>
                                    {state.posts_in_category.map((post) => {
                                        return ( <li key={post.id}><Link to={"/post/" + post.slug}>{post.title}</Link></li> )
                                    })}
                                    </ul>
                                    <br />
                                    <hr />
                                    </div> }
      
                                    
                                

                                <button className="btn readMore" onClick={props.history.goBack}>
                                    <i className="fas fa-arrow-left"></i> Go Back
                                </button>
                            </div>
                        </div>
                    } 
                    {loading ? null : <Sidebar recent={state.recent_post}/>}
                </div>
                 }
                <Footer />
            </main>
        </div>
    )
}
