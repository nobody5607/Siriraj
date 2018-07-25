<div class="row">
<div class="col-12 col-md-3 col-xl-2 bd-sidebar">
    <form class="bd-search d-flex align-items-center">
        <span class="algolia-autocomplete" style="position: relative; display: inline-block; direction: ltr;"><input type="search" class="form-control ds-input" id="search-input" placeholder="Search..." autocomplete="off" spellcheck="false" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-owns="algolia-autocomplete-listbox-0" dir="auto" style="position: relative; vertical-align: top;"><pre aria-hidden="true" style="position: absolute; visibility: hidden; white-space: pre; font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; font-size: 16px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: normal; text-indent: 0px; text-rendering: auto; text-transform: none;"></pre><span class="ds-dropdown-menu" role="listbox" id="algolia-autocomplete-listbox-0" style="position: absolute; top: 100%; z-index: 100; display: none; left: 0px; right: auto;"><div class="ds-dataset-1"></div></span></span>
        <button class="btn btn-link bd-search-docs-toggle d-md-none p-0 ml-3 collapsed" type="button" data-toggle="collapse" data-target="#bd-docs-nav" aria-controls="bd-docs-nav" aria-expanded="false" aria-label="Toggle docs navigation"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30" focusable="false"><title>Menu</title><path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"></path></svg>
        </button>
    </form>

    <nav class="bd-links collapse show" id="bd-docs-nav" style="">
        <div class="bd-toc-item">
            <a class="bd-toc-link" href="/docs/4.0/getting-started/introduction/">
                Getting started
            </a> 
        </div>
        <div class="bd-toc-item">
            <a class="bd-toc-link" href="/docs/4.0/layout/overview/">
                Layout
            </a>
        </div>
        <div class="bd-toc-item">
            <a class="bd-toc-link" href="/docs/4.0/content/reboot/">
                Content
            </a> 
        </div>
        <div class="bd-toc-item active">
            <a class="bd-toc-link" href="/docs/4.0/components/alerts/">
                Components
            </a>             
        </div><div class="bd-toc-item">
            <a class="bd-toc-link" href="/docs/4.0/utilities/borders/">
                Utilities
            </a>             
        </div>
        <div class="bd-toc-item">
            <a class="bd-toc-link" href="/docs/4.0/extend/approach/">
                Extend
            </a>
        </div>
        <div class="bd-toc-item">
            <a class="bd-toc-link" href="/docs/4.0/migration/">
                Migration
            </a>            
        </div>
        <div class="bd-toc-item">
            <a class="bd-toc-link" href="/docs/4.0/about/overview/">
                About
            </a>            
        </div>
    </nav>

</div>
<div class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content" role="main">
          <h1 class="bd-title" id="content">Introduction</h1>
</div>          
</div>  
<?php 
$this->registerCss("
    .bd-toc-link {
        display: block;
        padding: .25rem 1.5rem;
        font-weight: 500;
        color: rgba(0,0,0,.65);
    }
    .bd-sidebar .nav>.active:hover>a, .bd-sidebar .nav>.active>a {
        font-weight: 500;
        color: rgba(0,0,0,.85);
        background-color: transparent;
    }
    .bd-sidebar .nav>li>a {
        display: block;
        padding: .25rem 1.5rem;
        font-size: 90%;
        color: rgba(0,0,0,.65);
    }
    @media (min-width: 768px)
    {
        .bd-links {
            display: block!important;
        }
    }
    @media (min-width: 768px)
    {
        .bd-links {
            max-height: calc(100vh - 9rem);
            overflow-y: auto;
        }
    }
    .bd-links {
        padding-top: 1rem;
        padding-bottom: 1rem;
        margin-right: -15px;
        margin-left: -15px;
    }
    
    .bd-sidebar {
        -webkit-box-ordinal-group: 1;
        -ms-flex-order: 0;
        order: 0;
        border-bottom: 1px solid rgba(0,0,0,.1);
    } 
    
/*search */
.bd-search {
    position: relative;
    padding: 1rem 15px;
    margin-right: -15px;
    margin-left: -15px;
    border-bottom: 1px solid rgba(0,0,0,.05);
}
.align-items-center {
    -webkit-box-align: center!important;
    -ms-flex-align: center!important;
    align-items: center!important;
}
.algolia-autocomplete {
    display: block!important;
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
}

/*block*/
 .collapse.show {
    display: block;
}
.bd-toc-item.active>.bd-toc-link {
    color: rgba(0,0,0,.85);
}

.bd-toc-link {
    display: block;
    padding: .25rem 1.5rem;
    font-weight: 500;
    color: rgba(0,0,0,.65);
}
");
?>