import { useReducer, useRef, useState } from "react"

function reducer(state, action) {
    // prev
    // next
    // zoom-in
    // zoom-out
    // select-page-single
    // select-page-double
    // toggle-full-screen
    if (action.type === "prev") {
        if (state.no_of_pages === 1) return { ...state, page_no: state.page_no - 1 }
        else return { ...state, page_no: state.page_no - 2 }
    }
    else if (action.type.includes("next")) {
        if (state.no_of_pages === 1) return { ...state, page_no: state.page_no + 1 }
        else {
            // layout -> 2
            var p_arr_size = parseInt(action.type.split("#").splice(-1));
            if (state.page_no < p_arr_size - 1) {
                return { ...state, page_no: state.page_no + 2 }
            }
            else return state
        }

    }
    else if (action.type === "zoom-in") return { ...state, zoom: state.zoom + 10 }
    else if (action.type === "zoom-out") return { ...state, zoom: state.zoom - 10 }
    else if (action.type === "select-page-single") return { ...state, no_of_pages: 1 }
    else if (action.type === "select-page-double") {
        /* also have to consider the page count */
        var new_page_no = (state.page_no % 2) === 1 ? state.page_no : state.page_no - 1
        return { ...state, page_no: new_page_no, no_of_pages: 2 }
    }
    else if (action.type === "toggle-full-screen") {
        debugger;
        let elem = document.querySelector(".right-panel");

        if (!document.fullscreenElement) {
            elem.requestFullscreen().catch((err) => {
                alert(
                    `Error attempting to enable fullscreen mode: ${err.message} (${err.name})`,
                );
                return state;
            });
            return { ...state, is_full_screen: !(state.is_full_screen) };
        } else {
            document.exitFullscreen();
            return { ...state, is_full_screen: !(state.is_full_screen) };
        }
    }
    return state

}
/* .right-panel
if (document.fullscreenElement) {
            document.exitFullscreen()
        }
        else {
            document.querySelector(".right-panel").requestFullscreen();
        }
        return { ...state, is_full_screen: !(state.is_full_screen) };
*/


function EbookReader(props) {
    const toggleFullScreen = (full_screen_ref) => {

        if (!document.fullscreenElement) {
            
            full_screen_ref.current.requestFullscreen().catch((err) => {
                alert(
                    `Error attempting to enable fullscreen mode: ${err.message} (${err.name})`,
                );
            });
        } else {
            document.exitFullscreen();
        }
    }

    // define useReducer state;
    const [state, dispatch] = useReducer(reducer, {
        zoom: 95,
        page_no: 1, // 
        no_of_pages: 1, // h
        is_full_screen: false
    })
    const full_screen_ref = useRef(null);

    return (
        <div className="EbookReader">
            <LeftPanel />
            <div className="EbookReader right-panel" ref={full_screen_ref}>
                <Controls page_no={state.page_no}
                    prev={() => { if (state.page_no > 1) dispatch({ type: "prev" }) }}
                    next={() => { if (state.page_no < props.pages.length) dispatch({ type: `next#${props.pages.length}` }) }}
                    handle_zoom_in={() => { if (state.zoom < 250) dispatch({ type: "zoom-in" }) }}
                    handle_zoom_out={() => { if (state.zoom > 60) dispatch({ type: "zoom-out" }) }}
                    handle_select_single_page={() => { if (state.no_of_pages !== 1) dispatch({ type: "select-page-single" }) }}
                    handle_select_double_page={() => { if (state.no_of_pages !== 2) dispatch({ type: "select-page-double" }) }}
                    change_full_screen={() => toggleFullScreen(full_screen_ref)} />
                <BookDisplay pages={props.pages} page_no={state.page_no} layout={state.no_of_pages} zoom={state.zoom} />
            </div>
        </div>
    )
}

function LeftPanel() {
    return (
        <div className="EbookReader LeftPanel"></div>

    )

}

function Controls(props) {
    // var swipe_right = props.swipe_right;
    // var 
    var page_no = props.page_no
    // props -> page_no, prev, next, handle_zoom_in, handle_zoom_out, handle_select_single_page, handle_select_double_page
    return (
        <div className="Controls">
            <div className="controls-left">
                <button className="btn" onClick={props.handle_zoom_out}><img className="icon" src="./icons/zoom-out.png" /></button>
                <button className="btn" onClick={props.handle_zoom_in}><img className="icon" src="./icons/zoom-in.png" /></button>
                <button className="btn" onClick={props.handle_select_single_page}><img className="icon" src="./icons/single-page-layout-fold.png" /></button>
                <button className="btn" onClick={props.handle_select_double_page}><img className="icon" src="./icons/double-page-layout.png" /></button>
                <button className="btn" onClick={props.change_full_screen}><img className="icon" src="./icons/fullscreen.png" /></button>
            </div>
            <div className="controls-right">
                <button className="btn">Page {props.page_no}</button>
                <button className="btn" onClick={props.prev}><img className="icon" src="./icons/prev.png" /></button>
                <button className="btn" onClick={props.next}><img className="icon" src="./icons/next.png" /></button>
            </div>
        </div>
    )

}

function BookDisplay({ pages, page_no, layout, zoom }) {
    console.log(pages[parseInt(page_no)])
    console.log(page_no)
    var tmp_list = (layout === 1) ? [page_no] : [page_no, page_no + 1]
    var display_list = tmp_list.map(p_no => {
        var style = { height: `${zoom}%`, width: "auto" }
        if (p_no > pages.length) {
            return (<img className="page" src={`./img_samples/blank_page.jpg`} style={style} />)
        }
        else return (<img className="page" src={`./img_samples/${pages[p_no - 1]}.jpg`} style={style} />)
    })

    return (
        <div className="BookDisplay">
            {/* <iframe className="pdf" src="./one.pdf" width="800" height="90%"></iframe> */}
            {display_list}
        </div>
    )
}

export default EbookReader;