import React, {useState, useEffect} from 'react';
import {Link} from 'react-router-dom';
import ReactHtmlParser from 'react-html-parser';
import Header from './partials/Header';
import Footer from './partials/Footer';
import Sidebar from './partials/Sidebar';
import '../../css/portfolio.css';

const Portfolio = () => {

    // abort controller
    var controller = new AbortController();
    var signal = controller.signal;


    const [loading, setLoading] = useState(true);
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

                        setPortfolios(data.portfolios);
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
    

    return (
        <div className="main-container">
            <Header />

        <main>
                {loading ? null : <h1 className="portfolio-title">Portfolio</h1>}
                {loading ? "loading" : 
                        
                        portfolios.map((portfolio) => {
                            return (
                                <div className="portfolio-item">

                                
                                <div key={portfolio.id} className="portfolio-link">
                                            <div className="portfolio-link-image">
                                                <img src={portfolio.image} alt={portfolio.title} />
                                            </div>
                                            <div class="portfolio-link-text">
                                                <h3>{portfolio.title}</h3>
                                                <br/>
                                                <p>{portfolio.body}</p>
                                            </div>
                                                                
                                </div>
                                    <div class="expandable" id="{{$portfolio->id}}">
                                        <div class="expandable-top">
                                            <img src={portfolio.revealed_image} alt={portfolio.title} />
                                            <div class="expandable-text">
                                                <h3>{portfolio.revealed_title}</h3>
                                                <p>{portfolio.revealed_body}</p>
                                            </div>
                                        </div>
                                        <div class="expandable-middle">
                                            {portfolio.features.map((feature) => {
                                                switch(feature){
                                                    case "html":
                                                        return (
                                                            <div><i class="fab fa-html5"></i> <small>HTML5</small></div>
                                                        )
                                                    case "css":
                                                        return (
                                                            <div><i class="fab fa-css3-alt"></i> <small>CSS3</small></div>
                                                        )
                                                    case "js":
                                                        return (
                                                            <div><i class="fab fa-js"></i> <small>JavaScript</small></div>
                                                        )
                                                    case "php":
                                                        return (
                                                            <div><i class="fab fa-php"></i> <small>PHP</small></div>
                                                        )
                                                    case "laravel":
                                                        return (
                                                            <div><i class="fab fa-laravel"></i> <small>Laravel</small></div>
                                                        )
                                                    case "react":
                                                        return (
                                                            <div><i class="fab fa-react"></i> <small>React</small></div>
                                                        )
                                                    case "wordpress":
                                                        return (
                                                            <div><i class="fab fa-wordpress"></i> <small>Wordpress</small></div>
                                                        )
                                                    case "responsive":
                                                        return (
                                                            <div><i class="fab fa-mobile-alt"></i> <small>Responsive Design</small></div>
                                                        )
                                                    case "unity":
                                                        return (
                                                            <div><i class="fab fa-unity"></i> <small>Unity</small></div>
                                                        )
                                                    case "unity":
                                                        return (
                                                            <div><i class="fab fa-python"></i> <small>Python</small></div>
                                                        )
                                                }
                                            })}
                                            {portfolio.features.indexOf("html") !== -1 ?? <div><i class="fab fa-html5"></i> <small>HTML5</small></div>}


                                        </div>
                                        <div class="expandable-bottom">

                                            {portfolio.link_to_site  ? 
                                                <a class="btn" href={portfolio.link_to_site}><i class="far fa-window-maximize"></i> Live Demo</a> : null
                                            }

                                            {portfolio.link_to_source ?
                                                <a class="btn" href={portfolio.link_to_source}><i class="far fa-window-maximize"></i> Live sss</a> :
                                                // <p > style="color:#a1a1a1; margin: auto 0;"
                                                <p>
                                                    <i class="fas fa-lock"></i> Source Private
                                                </p>
                                            }

                                            {portfolio.link_to_blog ? 
                                                <a class="btn" href={portfolio.link_to_site}><i class="fas fa-pen"></i> Blog Page</a> : null
                                            }

                                            
                                        </div>
                                    </div>
                                </div>
                            )
                        })}

            <Footer />
        </main>
            
        </div>
    );
}

export default Portfolio;
