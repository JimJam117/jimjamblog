import React, {useState, useEffect} from 'react';
import {Link} from 'react-router-dom';
import ReactHtmlParser from 'react-html-parser';
import Header from './partials/Header';
import Footer from './partials/Footer';
import Sidebar from './partials/Sidebar';
import '../../css/portfolio.css';

import { css } from "@emotion/core";
import ClipLoader from "react-spinners/ClipLoader";

const Portfolio = () => {

    // abort controller
    var controller = new AbortController();
    var signal = controller.signal;


    const [loading, setLoading] = useState(true);
    const [revealedPortfolio, setRevealedPortfolio] = useState(0);
    const [portfolios, setPortfolios] = useState([]);

  
    const fetchItems = async (apiUrl = `/api/portfolio`) =>  {
        console.log("load");
                await fetch(apiUrl, {signal})
                    .then(async (response) => {
                        
                        //throw errors if issues
                        if (response.status === 500) {
                            console.log("500");
                        }
                        else if(response.status === 404) {
                            console.log("404");
                        }
                        else if(response.status === 419) {
                            console.log("419");
                        }
        
                        const data = await response.json();

                        

                        let sorted_portfolios = data.portfolios.sort((a,b) => {
                            return new Date(a.updated_at).getTime() - 
                                new Date(b.updated_at).getTime()
                        }).reverse();

                        setPortfolios(sorted_portfolios);

                        console.log(data.portfolios);
                        setLoading(false);
                })
            }

    useEffect(() => {
        if (loading) {fetchItems()}
        return () => {
            controller.abort();
        };
    }, [loading])
    
    const expand = (id) => {
        if (id === revealedPortfolio) {
            setRevealedPortfolio(0);
        }
        else {
            setRevealedPortfolio(id);
        }
        console.log(revealedPortfolio, id);
    }

    const getMiniFeatureListContent = (input, max) => {
        let newArray = input.features.filter((feature) => {
                                                
            if(!(miniFeatureListCount >= max ||
                feature == "html" ||
                feature == "css" ||
                feature == "js" ||
                feature == "php")) {

                miniFeatureListCount++;

                return feature;
            }

        });
        console.log("w9w", newArray)
        newArray = newArray.map((feature, i) => {
            if (feature == null) {
                return null;
            }

            let output = feature;
            output = output.replace(/^[A-Za-z]/, output.charAt(0).toUpperCase());

            if(newArray.indexOf(feature) == newArray.length - 1) {
                return <div key={`${input.id}-mini-list-${feature}-${i}`}>{`${output}...`}</div>;
            } 
            else {
                return <div key={`${input.id}-mini-list-${feature}-${i}`}>{`${output},`}</div>;
            }
        });
        return newArray;

        /*            else if(miniFeatureListCount == max - 1) {
                miniFeatureListCount++;
                let output = feature;
                output = output.replace(/^[A-Za-z]/, output.charAt(0).toUpperCase()); 
                return <div key={`${input.id}-mini-list-${feature}-${i}`}>{output}...</div>
            }*/
    }

    let miniFeatureListCount = 0;


    return (
        <div className="main-container">
            <Header />

        <main>
                {loading ? null : <h1 className="portfolio-title">Portfolio</h1>}
                {loading ? <div className="spinner"><ClipLoader /></div> : 
                        <div className="portfolio-grid-container">
                        {portfolios.map((portfolio) => {
                            miniFeatureListCount = 0;
                            return ([
                                

                                
                                <div className="portfolio-link" onClick={() => expand(portfolio.id)} key={portfolio.id}>
                                            <div className="portfolio-link-image">
                                                <img src={portfolio.image} alt={portfolio.title} />
                                            </div>
                                            <div className="portfolio-link-text">
                                                <h3>{portfolio.title}</h3>
                                                <br/>
                                                <p>{portfolio.body}</p>
                                            </div>  
                                            <div className="mini-feature-list">
                                            {getMiniFeatureListContent(portfolio, 2).map((lad) => lad)}
                                            </div>                        
                                </div>,
                                
                                    
                                    <div key={portfolio.id + "expandable"} className={revealedPortfolio === portfolio.id ? "expandable expanded" : "expandable"} id={portfolio.id}>
                                        <div className="expandable-top">
                                            <img src={portfolio.revealed_image} alt={portfolio.title} />
                                            <div className="expandable-text">
                                                <h3>{portfolio.revealed_title}</h3>
                                                <p>{portfolio.revealed_body}</p>
                                            </div>
                                        </div>
                                        <div className="expandable-middle">
                                            {portfolio.features.map((feature) => {
                                                switch(feature){
                                                    case "html":
                                                        return (
                                                            <div key={`${portfolio.id}html`}><i className="fab fa-html5"></i> <small>HTML5</small></div>
                                                        )
                                                    case "css":
                                                        return (
                                                            <div key={`${portfolio.id}css`}><i className="fab fa-css3-alt"></i> <small>CSS3</small></div>
                                                        )
                                                    case "js":
                                                        return (
                                                            <div key={`${portfolio.id}js`}><i className="fab fa-js"></i> <small>JavaScript</small></div>
                                                        )
                                                    case "php":
                                                        return (
                                                            <div key={`${portfolio.id}php`}><i className="fab fa-php"></i> <small>PHP</small></div>
                                                        )
                                                    case "laravel":
                                                        return (
                                                            <div key={`${portfolio.id}laravel`}><i className="fab fa-laravel"></i> <small>Laravel</small></div>
                                                        )
                                                    case "react":
                                                        return (
                                                            <div key={`${portfolio.id}react`}><i className="fab fa-react"></i> <small>React</small></div>
                                                        )
                                                    case "wordpress":
                                                        return (
                                                            <div key={`${portfolio.id}wordpress`}><i className="fab fa-wordpress"></i> <small>Wordpress</small></div>
                                                        )
                                                    case "responsive":
                                                        return (
                                                            <div key={`${portfolio.id}responsive`}><i className="fas fa-mobile-alt"></i> <small>Responsive Design</small></div>
                                                        )
                                                    case "unity":
                                                        return (
                                                            <div key={`${portfolio.id}unity`}><i className="fab fa-unity"></i> <small>Unity</small></div>
                                                        )
                                                    case "python":
                                                        return (
                                                            <div key={`${portfolio.id}python`}><i className="fab fa-python"></i> <small>Python</small></div>
                                                        )
                                                }
                                            })}
                                        </div>
                                        <div className="expandable-bottom">

                                            {portfolio.link_to_site  ? 
                                                <a className="btn" href={portfolio.link_to_site}><i className="far fa-window-maximize"></i> Live Demo</a> : null
                                            }

                                            {portfolio.link_to_source ?
                                                <a className="btn" href={portfolio.link_to_source}><i className="fas fa-code"></i> Source</a> :
                                                // <p > style="color:#a1a1a1; margin: auto 0;"
                                                <p className="sourcePrivate">
                                                    <i className="fas fa-lock"></i> Source Private
                                                </p>
                                            }

                                            {portfolio.link_to_blog ? 
                                                <a className="btn" href={portfolio.link_to_blog}><i className="fas fa-pen"></i> Blog Page</a> : null
                                            }

                                            
                                        </div>
                                
                                   
                                    </div>]
                            )
                        }
                        
                )}</div>}

            <Footer />
        </main>
            
        </div>
    );
}

export default Portfolio;
