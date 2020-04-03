import React from 'react';
import {Link} from 'react-router-dom';

export default function Sidebar(props) {

    console.log(props.recent);

    const recentPost = () => {
        return props.recent 
            ?   
                <div style={{'marginTop': 30}}>
                    <h3>Recent Post</h3>
                    <Link to={"/post/" + props.recent.slug} className="sidebar_post">
                        <img className="sidebar_post_image" src={"https://jsparrow.uk/" + props.recent.image} alt={props.recent.title}/>
                        <div className="sidebar_post_content">
                            <h4>{(props.recent.title.replace(/(<([^>]+)>)/ig,"").substring(0,40) + "...")}</h4>
                            <p>{(props.recent.body.replace(/(<([^>]+)>)/ig,"").substring(0,60) + "...")}</p>
                        </div>    
                    </Link>
                </div>
            : null;
    }

    return (
    <div className="sidebar">
        <h3>Links</h3>
        <ul style={{'listStyle': 'none'}}>
            <li>
                <a className="btn sidebar-btn" href="/github"><i className="fab fa-github"></i> Github</a>
            </li>
            <li>
                <a className="btn sidebar-btn" href="/contact"><i className="fas fa-envelope-square"></i> Contact</a>
            </li>
        </ul>
        {recentPost()}
    </div>
    )
}