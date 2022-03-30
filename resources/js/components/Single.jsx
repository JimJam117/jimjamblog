import React, {useState, useEffect} from 'react'
import Header from './partials/Header';
import Footer from './partials/Footer';
import Search from './partials/Search';
import Sidebar from './partials/Sidebar';
import ReactHtmlParser from 'react-html-parser'; 

import { css } from "@emotion/core";
import ClipLoader from "react-spinners/ClipLoader";
import { Link } from 'react-router-dom';

export default function Single(props) {

    // search state
    const [searchDisplay, setSearchDisplay] = useState(false);
    const setDisplay = (input) => setSearchDisplay(input);

    // abort controller
    var controller = new AbortController();
    var signal = controller.signal;

    // post state
    const [state, setState] = useState({});
    const [loading, setLoading] = useState(true);

    const fetchItem = async () => { await fetch('/api/post/' + props.match.params.id, {
        method: "GET",
        signal: signal,
        headers : { 
          'Content-Type': 'text/html',
          'Accept': 'text/html'
       }}).then(async(response) => {
        const data = await response.json();    
        await setState(data);
        setLoading(false);
        }).catch(err => {
            if (err.name === 'AbortError') {
                // console.log('Promise Aborted');
            } else {
                // console.log('Promise Rejected');
            }
        });
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
                            <img className="post_thumbnail" src={state.post.image} alt={state.post.title}></img>
                            <div className="post_container">
                                <div className="timestamp">{state.post.created_at}</div>
                                {state.category && <Link to={"/category/" + state.category.title}>This post is in the category: <em>{state.category.title}</em></Link>}
                                <h1>{state.post.title}</h1>

                                {ReactHtmlParser(state.post.body)}

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
