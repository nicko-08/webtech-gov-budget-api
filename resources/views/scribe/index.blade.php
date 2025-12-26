<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Government Budget API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
                    body .content .php-example code { display: none; }
                    body .content .python-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost:8000";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.6.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.6.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;,&quot;php&quot;,&quot;python&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                                            <button type="button" class="lang-button" data-language-name="php">php</button>
                                            <button type="button" class="lang-button" data-language-name="python">python</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-analytics" class="tocify-header">
                <li class="tocify-item level-1" data-unique="analytics">
                    <a href="#analytics">Analytics</a>
                </li>
                                    <ul id="tocify-subheader-analytics" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="analytics-GETapi-v1-analytics-overall-summary">
                                <a href="#analytics-GETapi-v1-analytics-overall-summary">Get overall summary analytics (all barangays combined)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="analytics-GETapi-v1-analytics-barangay-list">
                                <a href="#analytics-GETapi-v1-analytics-barangay-list">Get barangay list for selection cards</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="analytics-GETapi-v1-analytics-barangay--budgetId-">
                                <a href="#analytics-GETapi-v1-analytics-barangay--budgetId-">Get detailed analytics for specific barangay</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-authentication" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authentication">
                    <a href="#authentication">Authentication</a>
                </li>
                                    <ul id="tocify-subheader-authentication" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-register">
                                <a href="#authentication-POSTapi-v1-register">Register a new user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-login">
                                <a href="#authentication-POSTapi-v1-login">Login user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-logout">
                                <a href="#authentication-POSTapi-v1-logout">Logout user</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-budgets" class="tocify-header">
                <li class="tocify-item level-1" data-unique="budgets">
                    <a href="#budgets">Budgets</a>
                </li>
                                    <ul id="tocify-subheader-budgets" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="budgets-GETapi-v1-budgets">
                                <a href="#budgets-GETapi-v1-budgets">List budgets</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="budgets-GETapi-v1-budgets--id-">
                                <a href="#budgets-GETapi-v1-budgets--id-">Show budget</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="budgets-POSTapi-v1-budgets">
                                <a href="#budgets-POSTapi-v1-budgets">Create budget</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="budgets-PUTapi-v1-budgets--id-">
                                <a href="#budgets-PUTapi-v1-budgets--id-">Update budget</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="budgets-DELETEapi-v1-budgets--id-">
                                <a href="#budgets-DELETEapi-v1-budgets--id-">Delete budget</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-budget-items" class="tocify-header">
                <li class="tocify-item level-1" data-unique="budget-items">
                    <a href="#budget-items">Budget Items</a>
                </li>
                                    <ul id="tocify-subheader-budget-items" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="budget-items-GETapi-v1-budget-items">
                                <a href="#budget-items-GETapi-v1-budget-items">List budget items</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="budget-items-GETapi-v1-budget-items--id-">
                                <a href="#budget-items-GETapi-v1-budget-items--id-">Show budget item</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="budget-items-GETapi-v1-budget-items--budgetItem_id--summary">
                                <a href="#budget-items-GETapi-v1-budget-items--budgetItem_id--summary">Get budget item summary</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="budget-items-POSTapi-v1-budget-items">
                                <a href="#budget-items-POSTapi-v1-budget-items">Create budget item</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="budget-items-PUTapi-v1-budget-items--id-">
                                <a href="#budget-items-PUTapi-v1-budget-items--id-">Update budget item</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="budget-items-DELETEapi-v1-budget-items--id-">
                                <a href="#budget-items-DELETEapi-v1-budget-items--id-">Delete budget item</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-expenses" class="tocify-header">
                <li class="tocify-item level-1" data-unique="expenses">
                    <a href="#expenses">Expenses</a>
                </li>
                                    <ul id="tocify-subheader-expenses" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="expenses-GETapi-v1-expenses">
                                <a href="#expenses-GETapi-v1-expenses">List expenses</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="expenses-GETapi-v1-expenses--id-">
                                <a href="#expenses-GETapi-v1-expenses--id-">Show expense</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="expenses-POSTapi-v1-expenses">
                                <a href="#expenses-POSTapi-v1-expenses">Create expense</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="expenses-PUTapi-v1-expenses--id-">
                                <a href="#expenses-PUTapi-v1-expenses--id-">Update expense</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="expenses-DELETEapi-v1-expenses--id-">
                                <a href="#expenses-DELETEapi-v1-expenses--id-">Delete expense</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-budget-categories" class="tocify-header">
                <li class="tocify-item level-1" data-unique="budget-categories">
                    <a href="#budget-categories">Budget Categories</a>
                </li>
                                    <ul id="tocify-subheader-budget-categories" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="budget-categories-GETapi-v1-budget-categories">
                                <a href="#budget-categories-GETapi-v1-budget-categories">List budget categories</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="budget-categories-POSTapi-v1-budget-categories">
                                <a href="#budget-categories-POSTapi-v1-budget-categories">Create budget category</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="budget-categories-GETapi-v1-budget-categories--id-">
                                <a href="#budget-categories-GETapi-v1-budget-categories--id-">Show budget category</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="budget-categories-PUTapi-v1-budget-categories--id-">
                                <a href="#budget-categories-PUTapi-v1-budget-categories--id-">Update budget category</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="budget-categories-DELETEapi-v1-budget-categories--id-">
                                <a href="#budget-categories-DELETEapi-v1-budget-categories--id-">Delete budget category</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-fiscal-years" class="tocify-header">
                <li class="tocify-item level-1" data-unique="fiscal-years">
                    <a href="#fiscal-years">Fiscal Years</a>
                </li>
                                    <ul id="tocify-subheader-fiscal-years" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="fiscal-years-GETapi-v1-fiscal-years">
                                <a href="#fiscal-years-GETapi-v1-fiscal-years">List fiscal years</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="fiscal-years-POSTapi-v1-fiscal-years">
                                <a href="#fiscal-years-POSTapi-v1-fiscal-years">Create fiscal year</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="fiscal-years-GETapi-v1-fiscal-years--id-">
                                <a href="#fiscal-years-GETapi-v1-fiscal-years--id-">Show fiscal year</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="fiscal-years-PUTapi-v1-fiscal-years--id-">
                                <a href="#fiscal-years-PUTapi-v1-fiscal-years--id-">Update fiscal year</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="fiscal-years-DELETEapi-v1-fiscal-years--id-">
                                <a href="#fiscal-years-DELETEapi-v1-fiscal-years--id-">Delete fiscal year</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-users" class="tocify-header">
                <li class="tocify-item level-1" data-unique="users">
                    <a href="#users">Users</a>
                </li>
                                    <ul id="tocify-subheader-users" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="users-GETapi-v1-users">
                                <a href="#users-GETapi-v1-users">List users</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="users-POSTapi-v1-users">
                                <a href="#users-POSTapi-v1-users">Create user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="users-GETapi-v1-users--id-">
                                <a href="#users-GETapi-v1-users--id-">Show user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="users-PUTapi-v1-users--id-">
                                <a href="#users-PUTapi-v1-users--id-">Update user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="users-DELETEapi-v1-users--id-">
                                <a href="#users-DELETEapi-v1-users--id-">Delete user</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-government-units" class="tocify-header">
                <li class="tocify-item level-1" data-unique="government-units">
                    <a href="#government-units">Government Units  </a>
                </li>
                                    <ul id="tocify-subheader-government-units" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="government-units-GETapi-v1-government-units">
                                <a href="#government-units-GETapi-v1-government-units">List government units</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="government-units-POSTapi-v1-government-units">
                                <a href="#government-units-POSTapi-v1-government-units">Create government unit</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="government-units-GETapi-v1-government-units--id-">
                                <a href="#government-units-GETapi-v1-government-units--id-">Show government unit</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="government-units-PUTapi-v1-government-units--id-">
                                <a href="#government-units-PUTapi-v1-government-units--id-">Update government unit</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="government-units-DELETEapi-v1-government-units--id-">
                                <a href="#government-units-DELETEapi-v1-government-units--id-">Delete government unit</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: December 26, 2025</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>API for managing government budgets, expenses, and analytics for government units.</p>
<aside>
    <strong>Base URL</strong>: <code>http://localhost:8000</code>
</aside>
<pre><code>This documentation provides all the information you need to work with the Government Budget API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right.&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {YOUR_TOKEN}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>You can retrieve your token by making a POST request to <code>/api/v1/login</code> endpoint.</p>

        <h1 id="analytics">Analytics</h1>

    <p>Analytics endpoints for dashboard data</p>

                                <h2 id="analytics-GETapi-v1-analytics-overall-summary">Get overall summary analytics (all barangays combined)</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-analytics-overall-summary">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/analytics/overall-summary" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Authorization: Bearer {YOUR_TOKEN}"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/analytics/overall-summary"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {YOUR_TOKEN}",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/analytics/overall-summary';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/analytics/overall-summary'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {YOUR_TOKEN}'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-analytics-overall-summary">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 58
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Overall summary retrieved successfully&quot;,
    &quot;data&quot;: {
        &quot;total_allocated&quot;: 18528729,
        &quot;total_spent&quot;: 7410478,
        &quot;utilization_rate&quot;: 39.99,
        &quot;remaining_budget&quot;: 11118251,
        &quot;spending_by_category&quot;: {
            &quot;Infrastructure Development&quot;: 3728913,
            &quot;Health and Sanitation&quot;: 1260323,
            &quot;Education and Youth&quot;: 1173454,
            &quot;Peace and Order&quot;: 1247788
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-analytics-overall-summary" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-analytics-overall-summary"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-analytics-overall-summary"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-analytics-overall-summary" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-analytics-overall-summary">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-analytics-overall-summary" data-method="GET"
      data-path="api/v1/analytics/overall-summary"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-analytics-overall-summary', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-analytics-overall-summary"
                    onclick="tryItOut('GETapi-v1-analytics-overall-summary');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-analytics-overall-summary"
                    onclick="cancelTryOut('GETapi-v1-analytics-overall-summary');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-analytics-overall-summary"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/analytics/overall-summary</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-analytics-overall-summary"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-analytics-overall-summary"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization"                data-endpoint="GETapi-v1-analytics-overall-summary"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                        </form>

                    <h2 id="analytics-GETapi-v1-analytics-barangay-list">Get barangay list for selection cards</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-analytics-barangay-list">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/analytics/barangay-list" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Authorization: Bearer {YOUR_TOKEN}"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/analytics/barangay-list"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {YOUR_TOKEN}",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/analytics/barangay-list';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/analytics/barangay-list'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {YOUR_TOKEN}'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-analytics-barangay-list">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 58
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Barangay list retrieved successfully&quot;,
    &quot;data&quot;: [
        {
            &quot;budget_id&quot;: 1,
            &quot;barangay_name&quot;: &quot;Barangay San Antonio&quot;,
            &quot;budget_name&quot;: &quot;Barangay San Antonio Annual Budget 2026&quot;,
            &quot;total_allocated&quot;: 3855348,
            &quot;total_spent&quot;: 1662112,
            &quot;utilization_rate&quot;: 43.11,
            &quot;status&quot;: &quot;Under Budget&quot;
        },
        {
            &quot;budget_id&quot;: 2,
            &quot;barangay_name&quot;: &quot;Barangay Santo Domingo&quot;,
            &quot;budget_name&quot;: &quot;Barangay Santo Domingo Annual Budget 2026&quot;,
            &quot;total_allocated&quot;: 3797975,
            &quot;total_spent&quot;: 1276205,
            &quot;utilization_rate&quot;: 33.6,
            &quot;status&quot;: &quot;Under Budget&quot;
        },
        {
            &quot;budget_id&quot;: 3,
            &quot;barangay_name&quot;: &quot;Barangay Bagong Pag-asa&quot;,
            &quot;budget_name&quot;: &quot;Barangay Bagong Pag-asa Annual Budget 2026&quot;,
            &quot;total_allocated&quot;: 3593065,
            &quot;total_spent&quot;: 1367918,
            &quot;utilization_rate&quot;: 38.07,
            &quot;status&quot;: &quot;Under Budget&quot;
        },
        {
            &quot;budget_id&quot;: 4,
            &quot;barangay_name&quot;: &quot;Barangay Tatalon&quot;,
            &quot;budget_name&quot;: &quot;Barangay Tatalon Annual Budget 2026&quot;,
            &quot;total_allocated&quot;: 3550378,
            &quot;total_spent&quot;: 1570098,
            &quot;utilization_rate&quot;: 44.22,
            &quot;status&quot;: &quot;Under Budget&quot;
        },
        {
            &quot;budget_id&quot;: 5,
            &quot;barangay_name&quot;: &quot;Barangay Kamuning&quot;,
            &quot;budget_name&quot;: &quot;Barangay Kamuning Annual Budget 2026&quot;,
            &quot;total_allocated&quot;: 3731963,
            &quot;total_spent&quot;: 1534145,
            &quot;utilization_rate&quot;: 41.11,
            &quot;status&quot;: &quot;Under Budget&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-analytics-barangay-list" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-analytics-barangay-list"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-analytics-barangay-list"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-analytics-barangay-list" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-analytics-barangay-list">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-analytics-barangay-list" data-method="GET"
      data-path="api/v1/analytics/barangay-list"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-analytics-barangay-list', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-analytics-barangay-list"
                    onclick="tryItOut('GETapi-v1-analytics-barangay-list');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-analytics-barangay-list"
                    onclick="cancelTryOut('GETapi-v1-analytics-barangay-list');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-analytics-barangay-list"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/analytics/barangay-list</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-analytics-barangay-list"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-analytics-barangay-list"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization"                data-endpoint="GETapi-v1-analytics-barangay-list"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                        </form>

                    <h2 id="analytics-GETapi-v1-analytics-barangay--budgetId-">Get detailed analytics for specific barangay</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-analytics-barangay--budgetId-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/analytics/barangay/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Authorization: Bearer {YOUR_TOKEN}"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/analytics/barangay/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {YOUR_TOKEN}",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/analytics/barangay/architecto';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/analytics/barangay/architecto'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {YOUR_TOKEN}'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-analytics-barangay--budgetId-">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 58
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-analytics-barangay--budgetId-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-analytics-barangay--budgetId-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-analytics-barangay--budgetId-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-analytics-barangay--budgetId-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-analytics-barangay--budgetId-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-analytics-barangay--budgetId-" data-method="GET"
      data-path="api/v1/analytics/barangay/{budgetId}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-analytics-barangay--budgetId-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-analytics-barangay--budgetId-"
                    onclick="tryItOut('GETapi-v1-analytics-barangay--budgetId-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-analytics-barangay--budgetId-"
                    onclick="cancelTryOut('GETapi-v1-analytics-barangay--budgetId-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-analytics-barangay--budgetId-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/analytics/barangay/{budgetId}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-analytics-barangay--budgetId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-analytics-barangay--budgetId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization"                data-endpoint="GETapi-v1-analytics-barangay--budgetId-"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>budgetId</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="budgetId"                data-endpoint="GETapi-v1-analytics-barangay--budgetId-"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                <h1 id="authentication">Authentication</h1>

    <p>User authentication endpoints</p>

                                <h2 id="authentication-POSTapi-v1-register">Register a new user</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --data "{
    \"name\": \"John Doe\",
    \"email\": \"john@example.com\",
    \"password\": \"password123\",
    \"password_confirmation\": \"password123\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {YOUR_TOKEN}",
};

let body = {
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/register';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
        ],
        'json' =&gt; [
            'name' =&gt; 'John Doe',
            'email' =&gt; 'john@example.com',
            'password' =&gt; 'password123',
            'password_confirmation' =&gt; 'password123',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/register'
payload = {
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {YOUR_TOKEN}'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-register">
</span>
<span id="execution-results-POSTapi-v1-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-register" data-method="POST"
      data-path="api/v1/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-register"
                    onclick="tryItOut('POSTapi-v1-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-register"
                    onclick="cancelTryOut('POSTapi-v1-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization"                data-endpoint="POSTapi-v1-register"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-register"
               value="John Doe"
               data-component="body">
    <br>
<p>The user's full name. Example: <code>John Doe</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-register"
               value="john@example.com"
               data-component="body">
    <br>
<p>The user's email address. Example: <code>john@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-register"
               value="password123"
               data-component="body">
    <br>
<p>The user's password. Example: <code>password123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password_confirmation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password_confirmation"                data-endpoint="POSTapi-v1-register"
               value="password123"
               data-component="body">
    <br>
<p>Password confirmation (must match password). Example: <code>password123</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-v1-login">Login user</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --data "{
    \"email\": \"admin@example.com\",
    \"password\": \"password\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {YOUR_TOKEN}",
};

let body = {
    "email": "admin@example.com",
    "password": "password"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/login';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
        ],
        'json' =&gt; [
            'email' =&gt; 'admin@example.com',
            'password' =&gt; 'password',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/login'
payload = {
    "email": "admin@example.com",
    "password": "password"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {YOUR_TOKEN}'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-login">
</span>
<span id="execution-results-POSTapi-v1-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-login" data-method="POST"
      data-path="api/v1/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-login"
                    onclick="tryItOut('POSTapi-v1-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-login"
                    onclick="cancelTryOut('POSTapi-v1-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization"                data-endpoint="POSTapi-v1-login"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-login"
               value="admin@example.com"
               data-component="body">
    <br>
<p>User email address. Example: <code>admin@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-login"
               value="password"
               data-component="body">
    <br>
<p>User password. Example: <code>password</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-v1-logout">Logout user</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/logout" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/logout"
);

const headers = {
    "Authorization": "Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/logout';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/logout'
headers = {
  'Authorization': 'Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-logout">
</span>
<span id="execution-results-POSTapi-v1-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-logout" data-method="POST"
      data-path="api/v1/logout"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-logout"
                    onclick="tryItOut('POSTapi-v1-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-logout"
                    onclick="cancelTryOut('POSTapi-v1-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-logout"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="budgets">Budgets</h1>

    <p>Budget management endpoints</p>

                                <h2 id="budgets-GETapi-v1-budgets">List budgets</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-budgets">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/budgets?page=1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Authorization: Bearer {YOUR_TOKEN}"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/budgets"
);

const params = {
    "page": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {YOUR_TOKEN}",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/budgets';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
        ],
        'query' =&gt; [
            'page' =&gt; '1',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/budgets'
params = {
  'page': '1',
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {YOUR_TOKEN}'
}

response = requests.request('GET', url, headers=headers, params=params)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-budgets">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 59
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 3,
            &quot;name&quot;: &quot;Barangay Bagong Pag-asa Annual Budget 2026&quot;,
            &quot;total_amount&quot;: 2777274,
            &quot;government_unit&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Barangay Bagong Pag-asa&quot;,
                &quot;type&quot;: &quot;barangay&quot;,
                &quot;parent_id&quot;: 1,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;
            },
            &quot;fiscal_year&quot;: {
                &quot;id&quot;: 1,
                &quot;year&quot;: &quot;2026&quot;,
                &quot;start_date&quot;: &quot;2026-01-01T00:00:00.000000Z&quot;,
                &quot;end_date&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
                &quot;is_active&quot;: true,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 4,
            &quot;name&quot;: &quot;Barangay Tatalon Annual Budget 2026&quot;,
            &quot;total_amount&quot;: 1728783,
            &quot;government_unit&quot;: {
                &quot;id&quot;: 5,
                &quot;name&quot;: &quot;Barangay Tatalon&quot;,
                &quot;type&quot;: &quot;barangay&quot;,
                &quot;parent_id&quot;: 1,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;
            },
            &quot;fiscal_year&quot;: {
                &quot;id&quot;: 1,
                &quot;year&quot;: &quot;2026&quot;,
                &quot;start_date&quot;: &quot;2026-01-01T00:00:00.000000Z&quot;,
                &quot;end_date&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
                &quot;is_active&quot;: true,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 5,
            &quot;name&quot;: &quot;Barangay Kamuning Annual Budget 2026&quot;,
            &quot;total_amount&quot;: 2126553,
            &quot;government_unit&quot;: {
                &quot;id&quot;: 6,
                &quot;name&quot;: &quot;Barangay Kamuning&quot;,
                &quot;type&quot;: &quot;barangay&quot;,
                &quot;parent_id&quot;: 1,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;
            },
            &quot;fiscal_year&quot;: {
                &quot;id&quot;: 1,
                &quot;year&quot;: &quot;2026&quot;,
                &quot;start_date&quot;: &quot;2026-01-01T00:00:00.000000Z&quot;,
                &quot;end_date&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
                &quot;is_active&quot;: true,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Barangay San Antonio Annual Budget 2026&quot;,
            &quot;total_amount&quot;: 2354918,
            &quot;government_unit&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Barangay San Antonio&quot;,
                &quot;type&quot;: &quot;barangay&quot;,
                &quot;parent_id&quot;: 1,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;
            },
            &quot;fiscal_year&quot;: {
                &quot;id&quot;: 1,
                &quot;year&quot;: &quot;2026&quot;,
                &quot;start_date&quot;: &quot;2026-01-01T00:00:00.000000Z&quot;,
                &quot;end_date&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
                &quot;is_active&quot;: true,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Barangay Santo Domingo Annual Budget 2026&quot;,
            &quot;total_amount&quot;: 2509021,
            &quot;government_unit&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Barangay Santo Domingo&quot;,
                &quot;type&quot;: &quot;barangay&quot;,
                &quot;parent_id&quot;: 1,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;
            },
            &quot;fiscal_year&quot;: {
                &quot;id&quot;: 1,
                &quot;year&quot;: &quot;2026&quot;,
                &quot;start_date&quot;: &quot;2026-01-01T00:00:00.000000Z&quot;,
                &quot;end_date&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
                &quot;is_active&quot;: true,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;
            }
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://localhost:8000/api/v1/budgets?page=1&quot;,
        &quot;last&quot;: &quot;http://localhost:8000/api/v1/budgets?page=1&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: null
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 1,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:8000/api/v1/budgets?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;page&quot;: 1,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://localhost:8000/api/v1/budgets&quot;,
        &quot;per_page&quot;: 15,
        &quot;to&quot;: 5,
        &quot;total&quot;: 5
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-budgets" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-budgets"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-budgets"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-budgets" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-budgets">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-budgets" data-method="GET"
      data-path="api/v1/budgets"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-budgets', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-budgets"
                    onclick="tryItOut('GETapi-v1-budgets');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-budgets"
                    onclick="cancelTryOut('GETapi-v1-budgets');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-budgets"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/budgets</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-budgets"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-budgets"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization"                data-endpoint="GETapi-v1-budgets"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="page"                data-endpoint="GETapi-v1-budgets"
               value="1"
               data-component="query">
    <br>
<p>Page number. Example: <code>1</code></p>
            </div>
                </form>

                    <h2 id="budgets-GETapi-v1-budgets--id-">Show budget</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-budgets--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/budgets/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Authorization: Bearer {YOUR_TOKEN}"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/budgets/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {YOUR_TOKEN}",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/budgets/1';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/budgets/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {YOUR_TOKEN}'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-budgets--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 59
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Barangay San Antonio Annual Budget 2026&quot;,
        &quot;total_amount&quot;: 2354918,
        &quot;government_unit&quot;: {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Barangay San Antonio&quot;,
            &quot;type&quot;: &quot;barangay&quot;,
            &quot;parent_id&quot;: 1,
            &quot;created_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;
        },
        &quot;fiscal_year&quot;: {
            &quot;id&quot;: 1,
            &quot;year&quot;: &quot;2026&quot;,
            &quot;start_date&quot;: &quot;2026-01-01T00:00:00.000000Z&quot;,
            &quot;end_date&quot;: &quot;2026-12-31T00:00:00.000000Z&quot;,
            &quot;is_active&quot;: true,
            &quot;created_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-budgets--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-budgets--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-budgets--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-budgets--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-budgets--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-budgets--id-" data-method="GET"
      data-path="api/v1/budgets/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-budgets--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-budgets--id-"
                    onclick="tryItOut('GETapi-v1-budgets--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-budgets--id-"
                    onclick="cancelTryOut('GETapi-v1-budgets--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-budgets--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/budgets/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-budgets--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-budgets--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization"                data-endpoint="GETapi-v1-budgets--id-"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-budgets--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the budget. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="budgets-POSTapi-v1-budgets">Create budget</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-budgets">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/budgets" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Annual Budget 2024\",
    \"government_unit_id\": 1,
    \"fiscal_year_id\": 1,
    \"total_amount\": 1000000
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/budgets"
);

const headers = {
    "Authorization": "Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Annual Budget 2024",
    "government_unit_id": 1,
    "fiscal_year_id": 1,
    "total_amount": 1000000
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/budgets';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'name' =&gt; 'Annual Budget 2024',
            'government_unit_id' =&gt; 1,
            'fiscal_year_id' =&gt; 1,
            'total_amount' =&gt; 1000000.0,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/budgets'
payload = {
    "name": "Annual Budget 2024",
    "government_unit_id": 1,
    "fiscal_year_id": 1,
    "total_amount": 1000000
}
headers = {
  'Authorization': 'Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-budgets">
</span>
<span id="execution-results-POSTapi-v1-budgets" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-budgets"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-budgets"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-budgets" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-budgets">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-budgets" data-method="POST"
      data-path="api/v1/budgets"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-budgets', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-budgets"
                    onclick="tryItOut('POSTapi-v1-budgets');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-budgets"
                    onclick="cancelTryOut('POSTapi-v1-budgets');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-budgets"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/budgets</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-budgets"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-budgets"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-budgets"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-budgets"
               value="Annual Budget 2024"
               data-component="body">
    <br>
<p>Budget name. Example: <code>Annual Budget 2024</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>government_unit_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="government_unit_id"                data-endpoint="POSTapi-v1-budgets"
               value="1"
               data-component="body">
    <br>
<p>Government unit ID. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>fiscal_year_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="fiscal_year_id"                data-endpoint="POSTapi-v1-budgets"
               value="1"
               data-component="body">
    <br>
<p>Fiscal year ID. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>total_amount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="total_amount"                data-endpoint="POSTapi-v1-budgets"
               value="1000000"
               data-component="body">
    <br>
<p>Total amount. Example: <code>1000000</code></p>
        </div>
        </form>

                    <h2 id="budgets-PUTapi-v1-budgets--id-">Update budget</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-budgets--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/budgets/1" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Revised Infrastructure Budget 2025\",
    \"government_unit_id\": 3,
    \"fiscal_year_id\": 2025,
    \"total_amount\": 175000000
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/budgets/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Revised Infrastructure Budget 2025",
    "government_unit_id": 3,
    "fiscal_year_id": 2025,
    "total_amount": 175000000
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/budgets/1';
$response = $client-&gt;put(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'name' =&gt; 'Revised Infrastructure Budget 2025',
            'government_unit_id' =&gt; 3,
            'fiscal_year_id' =&gt; 2025,
            'total_amount' =&gt; 175000000.0,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/budgets/1'
payload = {
    "name": "Revised Infrastructure Budget 2025",
    "government_unit_id": 3,
    "fiscal_year_id": 2025,
    "total_amount": 175000000
}
headers = {
  'Authorization': 'Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-budgets--id-">
</span>
<span id="execution-results-PUTapi-v1-budgets--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-budgets--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-budgets--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-budgets--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-budgets--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-budgets--id-" data-method="PUT"
      data-path="api/v1/budgets/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-budgets--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-budgets--id-"
                    onclick="tryItOut('PUTapi-v1-budgets--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-budgets--id-"
                    onclick="cancelTryOut('PUTapi-v1-budgets--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-budgets--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/budgets/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/budgets/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-budgets--id-"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-budgets--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-budgets--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-budgets--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the budget. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-v1-budgets--id-"
               value="Revised Infrastructure Budget 2025"
               data-component="body">
    <br>
<p>Updated official name of the budget. Must not be greater than 255 characters. Example: <code>Revised Infrastructure Budget 2025</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>government_unit_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="government_unit_id"                data-endpoint="PUTapi-v1-budgets--id-"
               value="3"
               data-component="body">
    <br>
<p>Updated ID of the government unit responsible for this budget. The <code>id</code> of an existing record in the government_units table. Example: <code>3</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>fiscal_year_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="fiscal_year_id"                data-endpoint="PUTapi-v1-budgets--id-"
               value="2025"
               data-component="body">
    <br>
<p>Updated ID of the fiscal year to which this budget applies. The <code>id</code> of an existing record in the fiscal_years table. Example: <code>2025</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>total_amount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="total_amount"                data-endpoint="PUTapi-v1-budgets--id-"
               value="175000000"
               data-component="body">
    <br>
<p>Updated total approved amount for the budget. Must be a non-negative number. Must be at least 0. Example: <code>175000000</code></p>
        </div>
        </form>

                    <h2 id="budgets-DELETEapi-v1-budgets--id-">Delete budget</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-budgets--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/budgets/1" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/budgets/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/budgets/1';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/budgets/1'
headers = {
  'Authorization': 'Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-budgets--id-">
</span>
<span id="execution-results-DELETEapi-v1-budgets--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-budgets--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-budgets--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-budgets--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-budgets--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-budgets--id-" data-method="DELETE"
      data-path="api/v1/budgets/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-budgets--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-budgets--id-"
                    onclick="tryItOut('DELETEapi-v1-budgets--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-budgets--id-"
                    onclick="cancelTryOut('DELETEapi-v1-budgets--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-budgets--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/budgets/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-budgets--id-"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-budgets--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-budgets--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-v1-budgets--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the budget. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="budget-items">Budget Items</h1>

    <p>Budget item management endpoints</p>

                                <h2 id="budget-items-GETapi-v1-budget-items">List budget items</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-budget-items">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/budget-items" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Authorization: Bearer {YOUR_TOKEN}"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/budget-items"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {YOUR_TOKEN}",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/budget-items';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/budget-items'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {YOUR_TOKEN}'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-budget-items">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 59
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 41,
            &quot;name&quot;: &quot;Barangay Health Station Supplies&quot;,
            &quot;code&quot;: &quot;BRG5-HEALTH-001&quot;,
            &quot;allocated_amount&quot;: 129705,
            &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;budget&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Barangay Tatalon Annual Budget 2026&quot;,
                &quot;total_amount&quot;: 1728783
            },
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Health and Sanitation&quot;
            }
        },
        {
            &quot;id&quot;: 59,
            &quot;name&quot;: &quot;CCTV Camera Installation&quot;,
            &quot;code&quot;: &quot;BRG6-PEACE-001&quot;,
            &quot;allocated_amount&quot;: 400232,
            &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;budget&quot;: {
                &quot;id&quot;: 5,
                &quot;name&quot;: &quot;Barangay Kamuning Annual Budget 2026&quot;,
                &quot;total_amount&quot;: 2126553
            },
            &quot;category&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Peace and Order&quot;
            }
        },
        {
            &quot;id&quot;: 56,
            &quot;name&quot;: &quot;Day Care Center Improvement&quot;,
            &quot;code&quot;: &quot;BRG6-EDU-001&quot;,
            &quot;allocated_amount&quot;: 304362,
            &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;budget&quot;: {
                &quot;id&quot;: 5,
                &quot;name&quot;: &quot;Barangay Kamuning Annual Budget 2026&quot;,
                &quot;total_amount&quot;: 2126553
            },
            &quot;category&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Education and Youth&quot;
            }
        },
        {
            &quot;id&quot;: 55,
            &quot;name&quot;: &quot;Vaccination Program&quot;,
            &quot;code&quot;: &quot;BRG6-HEALTH-003&quot;,
            &quot;allocated_amount&quot;: 122986,
            &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;budget&quot;: {
                &quot;id&quot;: 5,
                &quot;name&quot;: &quot;Barangay Kamuning Annual Budget 2026&quot;,
                &quot;total_amount&quot;: 2126553
            },
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Health and Sanitation&quot;
            }
        },
        {
            &quot;id&quot;: 54,
            &quot;name&quot;: &quot;Medical Equipment Purchase&quot;,
            &quot;code&quot;: &quot;BRG6-HEALTH-002&quot;,
            &quot;allocated_amount&quot;: 254057,
            &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;budget&quot;: {
                &quot;id&quot;: 5,
                &quot;name&quot;: &quot;Barangay Kamuning Annual Budget 2026&quot;,
                &quot;total_amount&quot;: 2126553
            },
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Health and Sanitation&quot;
            }
        },
        {
            &quot;id&quot;: 57,
            &quot;name&quot;: &quot;Learning Materials Purchase&quot;,
            &quot;code&quot;: &quot;BRG6-EDU-002&quot;,
            &quot;allocated_amount&quot;: 76614,
            &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;budget&quot;: {
                &quot;id&quot;: 5,
                &quot;name&quot;: &quot;Barangay Kamuning Annual Budget 2026&quot;,
                &quot;total_amount&quot;: 2126553
            },
            &quot;category&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Education and Youth&quot;
            }
        },
        {
            &quot;id&quot;: 45,
            &quot;name&quot;: &quot;Learning Materials Purchase&quot;,
            &quot;code&quot;: &quot;BRG5-EDU-002&quot;,
            &quot;allocated_amount&quot;: 52738,
            &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;budget&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Barangay Tatalon Annual Budget 2026&quot;,
                &quot;total_amount&quot;: 1728783
            },
            &quot;category&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Education and Youth&quot;
            }
        },
        {
            &quot;id&quot;: 44,
            &quot;name&quot;: &quot;Day Care Center Improvement&quot;,
            &quot;code&quot;: &quot;BRG5-EDU-001&quot;,
            &quot;allocated_amount&quot;: 260512,
            &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;budget&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Barangay Tatalon Annual Budget 2026&quot;,
                &quot;total_amount&quot;: 1728783
            },
            &quot;category&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Education and Youth&quot;
            }
        },
        {
            &quot;id&quot;: 43,
            &quot;name&quot;: &quot;Vaccination Program&quot;,
            &quot;code&quot;: &quot;BRG5-HEALTH-003&quot;,
            &quot;allocated_amount&quot;: 149420,
            &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;budget&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Barangay Tatalon Annual Budget 2026&quot;,
                &quot;total_amount&quot;: 1728783
            },
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Health and Sanitation&quot;
            }
        },
        {
            &quot;id&quot;: 42,
            &quot;name&quot;: &quot;Medical Equipment Purchase&quot;,
            &quot;code&quot;: &quot;BRG5-HEALTH-002&quot;,
            &quot;allocated_amount&quot;: 151052,
            &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;budget&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Barangay Tatalon Annual Budget 2026&quot;,
                &quot;total_amount&quot;: 1728783
            },
            &quot;category&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Health and Sanitation&quot;
            }
        },
        {
            &quot;id&quot;: 46,
            &quot;name&quot;: &quot;Youth Development Program&quot;,
            &quot;code&quot;: &quot;BRG5-EDU-003&quot;,
            &quot;allocated_amount&quot;: 80953,
            &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;budget&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Barangay Tatalon Annual Budget 2026&quot;,
                &quot;total_amount&quot;: 1728783
            },
            &quot;category&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Education and Youth&quot;
            }
        },
        {
            &quot;id&quot;: 40,
            &quot;name&quot;: &quot;Drainage System Improvement&quot;,
            &quot;code&quot;: &quot;BRG5-INFRA-004&quot;,
            &quot;allocated_amount&quot;: 537017,
            &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;budget&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Barangay Tatalon Annual Budget 2026&quot;,
                &quot;total_amount&quot;: 1728783
            },
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Infrastructure Development&quot;
            }
        },
        {
            &quot;id&quot;: 39,
            &quot;name&quot;: &quot;Street Lighting Installation&quot;,
            &quot;code&quot;: &quot;BRG5-INFRA-003&quot;,
            &quot;allocated_amount&quot;: 307419,
            &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;budget&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Barangay Tatalon Annual Budget 2026&quot;,
                &quot;total_amount&quot;: 1728783
            },
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Infrastructure Development&quot;
            }
        },
        {
            &quot;id&quot;: 38,
            &quot;name&quot;: &quot;Covered Court Construction&quot;,
            &quot;code&quot;: &quot;BRG5-INFRA-002&quot;,
            &quot;allocated_amount&quot;: 859854,
            &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;budget&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Barangay Tatalon Annual Budget 2026&quot;,
                &quot;total_amount&quot;: 1728783
            },
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Infrastructure Development&quot;
            }
        },
        {
            &quot;id&quot;: 37,
            &quot;name&quot;: &quot;Basketball Court Renovation&quot;,
            &quot;code&quot;: &quot;BRG5-INFRA-001&quot;,
            &quot;allocated_amount&quot;: 355676,
            &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;budget&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Barangay Tatalon Annual Budget 2026&quot;,
                &quot;total_amount&quot;: 1728783
            },
            &quot;category&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Infrastructure Development&quot;
            }
        },
        {
            &quot;id&quot;: 36,
            &quot;name&quot;: &quot;Barangay Patrol Equipment&quot;,
            &quot;code&quot;: &quot;BRG4-PEACE-002&quot;,
            &quot;allocated_amount&quot;: 196151,
            &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;budget&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Barangay Bagong Pag-asa Annual Budget 2026&quot;,
                &quot;total_amount&quot;: 2777274
            },
            &quot;category&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Peace and Order&quot;
            }
        },
        {
            &quot;id&quot;: 35,
            &quot;name&quot;: &quot;CCTV Camera Installation&quot;,
            &quot;code&quot;: &quot;BRG4-PEACE-001&quot;,
            &quot;allocated_amount&quot;: 322863,
            &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;budget&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Barangay Bagong Pag-asa Annual Budget 2026&quot;,
                &quot;total_amount&quot;: 2777274
            },
            &quot;category&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Peace and Order&quot;
            }
        },
        {
            &quot;id&quot;: 34,
            &quot;name&quot;: &quot;Youth Development Program&quot;,
            &quot;code&quot;: &quot;BRG4-EDU-003&quot;,
            &quot;allocated_amount&quot;: 109143,
            &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;budget&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Barangay Bagong Pag-asa Annual Budget 2026&quot;,
                &quot;total_amount&quot;: 2777274
            },
            &quot;category&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Education and Youth&quot;
            }
        },
        {
            &quot;id&quot;: 33,
            &quot;name&quot;: &quot;Learning Materials Purchase&quot;,
            &quot;code&quot;: &quot;BRG4-EDU-002&quot;,
            &quot;allocated_amount&quot;: 62854,
            &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;budget&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Barangay Bagong Pag-asa Annual Budget 2026&quot;,
                &quot;total_amount&quot;: 2777274
            },
            &quot;category&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Education and Youth&quot;
            }
        },
        {
            &quot;id&quot;: 32,
            &quot;name&quot;: &quot;Day Care Center Improvement&quot;,
            &quot;code&quot;: &quot;BRG4-EDU-001&quot;,
            &quot;allocated_amount&quot;: 231516,
            &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
            &quot;budget&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Barangay Bagong Pag-asa Annual Budget 2026&quot;,
                &quot;total_amount&quot;: 2777274
            },
            &quot;category&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Education and Youth&quot;
            }
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://localhost:8000/api/v1/budget-items?page=1&quot;,
        &quot;last&quot;: &quot;http://localhost:8000/api/v1/budget-items?page=3&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: &quot;http://localhost:8000/api/v1/budget-items?page=2&quot;
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 3,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:8000/api/v1/budget-items?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;page&quot;: 1,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: &quot;http://localhost:8000/api/v1/budget-items?page=2&quot;,
                &quot;label&quot;: &quot;2&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:8000/api/v1/budget-items?page=3&quot;,
                &quot;label&quot;: &quot;3&quot;,
                &quot;page&quot;: 3,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:8000/api/v1/budget-items?page=2&quot;,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://localhost:8000/api/v1/budget-items&quot;,
        &quot;per_page&quot;: 20,
        &quot;to&quot;: 20,
        &quot;total&quot;: 60
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-budget-items" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-budget-items"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-budget-items"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-budget-items" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-budget-items">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-budget-items" data-method="GET"
      data-path="api/v1/budget-items"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-budget-items', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-budget-items"
                    onclick="tryItOut('GETapi-v1-budget-items');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-budget-items"
                    onclick="cancelTryOut('GETapi-v1-budget-items');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-budget-items"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/budget-items</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-budget-items"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-budget-items"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization"                data-endpoint="GETapi-v1-budget-items"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                        </form>

                    <h2 id="budget-items-GETapi-v1-budget-items--id-">Show budget item</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-budget-items--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/budget-items/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Authorization: Bearer {YOUR_TOKEN}"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/budget-items/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {YOUR_TOKEN}",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/budget-items/1';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/budget-items/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {YOUR_TOKEN}'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-budget-items--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 59
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Basketball Court Renovation&quot;,
        &quot;code&quot;: &quot;BRG2-INFRA-001&quot;,
        &quot;allocated_amount&quot;: 402365,
        &quot;created_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;,
        &quot;budget&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Barangay San Antonio Annual Budget 2026&quot;,
            &quot;total_amount&quot;: 2354918
        },
        &quot;category&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Infrastructure Development&quot;
        },
        &quot;spent_amount&quot;: &quot;224778.00&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-budget-items--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-budget-items--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-budget-items--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-budget-items--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-budget-items--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-budget-items--id-" data-method="GET"
      data-path="api/v1/budget-items/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-budget-items--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-budget-items--id-"
                    onclick="tryItOut('GETapi-v1-budget-items--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-budget-items--id-"
                    onclick="cancelTryOut('GETapi-v1-budget-items--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-budget-items--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/budget-items/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-budget-items--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-budget-items--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization"                data-endpoint="GETapi-v1-budget-items--id-"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-budget-items--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the budget item. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="budget-items-GETapi-v1-budget-items--budgetItem_id--summary">Get budget item summary</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-budget-items--budgetItem_id--summary">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/budget-items/1/summary" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Authorization: Bearer {YOUR_TOKEN}"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/budget-items/1/summary"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {YOUR_TOKEN}",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/budget-items/1/summary';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/budget-items/1/summary'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {YOUR_TOKEN}'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-budget-items--budgetItem_id--summary">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 59
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Budget item summary retrieved successfully&quot;,
    &quot;data&quot;: {
        &quot;name&quot;: &quot;Basketball Court Renovation&quot;,
        &quot;code&quot;: &quot;BRG2-INFRA-001&quot;,
        &quot;allocated_amount&quot;: &quot;402365.00&quot;,
        &quot;spent_amount&quot;: &quot;224778.00&quot;,
        &quot;utilization_percentage&quot;: 55.86,
        &quot;budget&quot;: {
            &quot;name&quot;: &quot;Barangay San Antonio Annual Budget 2026&quot;
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-budget-items--budgetItem_id--summary" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-budget-items--budgetItem_id--summary"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-budget-items--budgetItem_id--summary"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-budget-items--budgetItem_id--summary" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-budget-items--budgetItem_id--summary">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-budget-items--budgetItem_id--summary" data-method="GET"
      data-path="api/v1/budget-items/{budgetItem_id}/summary"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-budget-items--budgetItem_id--summary', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-budget-items--budgetItem_id--summary"
                    onclick="tryItOut('GETapi-v1-budget-items--budgetItem_id--summary');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-budget-items--budgetItem_id--summary"
                    onclick="cancelTryOut('GETapi-v1-budget-items--budgetItem_id--summary');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-budget-items--budgetItem_id--summary"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/budget-items/{budgetItem_id}/summary</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-budget-items--budgetItem_id--summary"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-budget-items--budgetItem_id--summary"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization"                data-endpoint="GETapi-v1-budget-items--budgetItem_id--summary"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>budgetItem_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="budgetItem_id"                data-endpoint="GETapi-v1-budget-items--budgetItem_id--summary"
               value="1"
               data-component="url">
    <br>
<p>The ID of the budgetItem. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="budget-items-POSTapi-v1-budget-items">Create budget item</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-budget-items">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/budget-items" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"budget_id\": 1,
    \"budget_category_id\": 3,
    \"name\": \"Road and Bridge Maintenance\",
    \"code\": \"INFRA-RBM-001\",
    \"allocated_amount\": 2500000
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/budget-items"
);

const headers = {
    "Authorization": "Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "budget_id": 1,
    "budget_category_id": 3,
    "name": "Road and Bridge Maintenance",
    "code": "INFRA-RBM-001",
    "allocated_amount": 2500000
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/budget-items';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'budget_id' =&gt; 1,
            'budget_category_id' =&gt; 3,
            'name' =&gt; 'Road and Bridge Maintenance',
            'code' =&gt; 'INFRA-RBM-001',
            'allocated_amount' =&gt; 2500000.0,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/budget-items'
payload = {
    "budget_id": 1,
    "budget_category_id": 3,
    "name": "Road and Bridge Maintenance",
    "code": "INFRA-RBM-001",
    "allocated_amount": 2500000
}
headers = {
  'Authorization': 'Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-budget-items">
</span>
<span id="execution-results-POSTapi-v1-budget-items" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-budget-items"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-budget-items"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-budget-items" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-budget-items">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-budget-items" data-method="POST"
      data-path="api/v1/budget-items"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-budget-items', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-budget-items"
                    onclick="tryItOut('POSTapi-v1-budget-items');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-budget-items"
                    onclick="cancelTryOut('POSTapi-v1-budget-items');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-budget-items"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/budget-items</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-budget-items"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-budget-items"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-budget-items"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>budget_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="budget_id"                data-endpoint="POSTapi-v1-budget-items"
               value="1"
               data-component="body">
    <br>
<p>ID of the parent budget to which this budget item belongs. The <code>id</code> of an existing record in the budgets table. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>budget_category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="budget_category_id"                data-endpoint="POSTapi-v1-budget-items"
               value="3"
               data-component="body">
    <br>
<p>ID of the budget category used to classify this budget item. The <code>id</code> of an existing record in the budget_categories table. Example: <code>3</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-budget-items"
               value="Road and Bridge Maintenance"
               data-component="body">
    <br>
<p>Human-readable name of the budget item. Must not be greater than 255 characters. Example: <code>Road and Bridge Maintenance</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="POSTapi-v1-budget-items"
               value="INFRA-RBM-001"
               data-component="body">
    <br>
<p>Unique reference code for the budget item, used for tracking and reporting. Must not be greater than 50 characters. Example: <code>INFRA-RBM-001</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>allocated_amount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="allocated_amount"                data-endpoint="POSTapi-v1-budget-items"
               value="2500000"
               data-component="body">
    <br>
<p>Total amount allocated to this budget item. Must be a non-negative number. Must be at least 0. Example: <code>2500000</code></p>
        </div>
        </form>

                    <h2 id="budget-items-PUTapi-v1-budget-items--id-">Update budget item</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-budget-items--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/budget-items/1" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"budget_id\": 1,
    \"budget_category_id\": 3,
    \"name\": \"Road and Bridge Rehabilitation\",
    \"code\": \"INFRA-RBR-002\",
    \"allocated_amount\": 3000000
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/budget-items/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "budget_id": 1,
    "budget_category_id": 3,
    "name": "Road and Bridge Rehabilitation",
    "code": "INFRA-RBR-002",
    "allocated_amount": 3000000
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/budget-items/1';
$response = $client-&gt;put(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'budget_id' =&gt; 1,
            'budget_category_id' =&gt; 3,
            'name' =&gt; 'Road and Bridge Rehabilitation',
            'code' =&gt; 'INFRA-RBR-002',
            'allocated_amount' =&gt; 3000000.0,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/budget-items/1'
payload = {
    "budget_id": 1,
    "budget_category_id": 3,
    "name": "Road and Bridge Rehabilitation",
    "code": "INFRA-RBR-002",
    "allocated_amount": 3000000
}
headers = {
  'Authorization': 'Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-budget-items--id-">
</span>
<span id="execution-results-PUTapi-v1-budget-items--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-budget-items--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-budget-items--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-budget-items--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-budget-items--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-budget-items--id-" data-method="PUT"
      data-path="api/v1/budget-items/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-budget-items--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-budget-items--id-"
                    onclick="tryItOut('PUTapi-v1-budget-items--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-budget-items--id-"
                    onclick="cancelTryOut('PUTapi-v1-budget-items--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-budget-items--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/budget-items/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/budget-items/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-budget-items--id-"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-budget-items--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-budget-items--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-budget-items--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the budget item. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>budget_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="budget_id"                data-endpoint="PUTapi-v1-budget-items--id-"
               value="1"
               data-component="body">
    <br>
<p>ID of the parent budget to which this budget item belongs. The <code>id</code> of an existing record in the budgets table. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>budget_category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="budget_category_id"                data-endpoint="PUTapi-v1-budget-items--id-"
               value="3"
               data-component="body">
    <br>
<p>ID of the budget category used to classify this budget item. The <code>id</code> of an existing record in the budget_categories table. Example: <code>3</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-v1-budget-items--id-"
               value="Road and Bridge Rehabilitation"
               data-component="body">
    <br>
<p>Updated name of the budget item. Must not be greater than 255 characters. Example: <code>Road and Bridge Rehabilitation</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="PUTapi-v1-budget-items--id-"
               value="INFRA-RBR-002"
               data-component="body">
    <br>
<p>Updated unique reference code for the budget item. Must not be greater than 50 characters. Example: <code>INFRA-RBR-002</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>allocated_amount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="allocated_amount"                data-endpoint="PUTapi-v1-budget-items--id-"
               value="3000000"
               data-component="body">
    <br>
<p>Updated allocated amount for this budget item. Must be a non-negative number. Must be at least 0. Example: <code>3000000</code></p>
        </div>
        </form>

                    <h2 id="budget-items-DELETEapi-v1-budget-items--id-">Delete budget item</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-budget-items--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/budget-items/1" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/budget-items/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/budget-items/1';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/budget-items/1'
headers = {
  'Authorization': 'Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-budget-items--id-">
</span>
<span id="execution-results-DELETEapi-v1-budget-items--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-budget-items--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-budget-items--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-budget-items--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-budget-items--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-budget-items--id-" data-method="DELETE"
      data-path="api/v1/budget-items/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-budget-items--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-budget-items--id-"
                    onclick="tryItOut('DELETEapi-v1-budget-items--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-budget-items--id-"
                    onclick="cancelTryOut('DELETEapi-v1-budget-items--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-budget-items--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/budget-items/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-budget-items--id-"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-budget-items--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-budget-items--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-v1-budget-items--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the budget item. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="expenses">Expenses</h1>

    <p>Expense management endpoints</p>

                                <h2 id="expenses-GETapi-v1-expenses">List expenses</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-expenses">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/expenses" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Authorization: Bearer {YOUR_TOKEN}"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/expenses"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {YOUR_TOKEN}",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/expenses';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/expenses'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {YOUR_TOKEN}'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-expenses">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 59
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 109,
            &quot;description&quot;: &quot;Professional Services for Day Care Center Improvement&quot;,
            &quot;amount&quot;: 18328,
            &quot;transaction_date&quot;: &quot;2026-10-27T00:00:00.000000Z&quot;,
            &quot;budget_item&quot;: {
                &quot;id&quot;: 20,
                &quot;name&quot;: &quot;Day Care Center Improvement&quot;,
                &quot;code&quot;: &quot;BRG3-EDU-001&quot;,
                &quot;allocated_amount&quot;: 257518,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 94,
            &quot;description&quot;: &quot;Labor Cost for Medical Equipment Purchase&quot;,
            &quot;amount&quot;: 38117,
            &quot;transaction_date&quot;: &quot;2026-08-01T00:00:00.000000Z&quot;,
            &quot;budget_item&quot;: {
                &quot;id&quot;: 18,
                &quot;name&quot;: &quot;Medical Equipment Purchase&quot;,
                &quot;code&quot;: &quot;BRG3-HEALTH-002&quot;,
                &quot;allocated_amount&quot;: 285514,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 95,
            &quot;description&quot;: &quot;Labor Cost for Medical Equipment Purchase&quot;,
            &quot;amount&quot;: 70056,
            &quot;transaction_date&quot;: &quot;2026-10-27T00:00:00.000000Z&quot;,
            &quot;budget_item&quot;: {
                &quot;id&quot;: 18,
                &quot;name&quot;: &quot;Medical Equipment Purchase&quot;,
                &quot;code&quot;: &quot;BRG3-HEALTH-002&quot;,
                &quot;allocated_amount&quot;: 285514,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 103,
            &quot;description&quot;: &quot;Labor Cost for Day Care Center Improvement&quot;,
            &quot;amount&quot;: 20433,
            &quot;transaction_date&quot;: &quot;2026-06-04T00:00:00.000000Z&quot;,
            &quot;budget_item&quot;: {
                &quot;id&quot;: 20,
                &quot;name&quot;: &quot;Day Care Center Improvement&quot;,
                &quot;code&quot;: &quot;BRG3-EDU-001&quot;,
                &quot;allocated_amount&quot;: 257518,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 104,
            &quot;description&quot;: &quot;Labor Cost for Day Care Center Improvement&quot;,
            &quot;amount&quot;: 9491,
            &quot;transaction_date&quot;: &quot;2026-02-16T00:00:00.000000Z&quot;,
            &quot;budget_item&quot;: {
                &quot;id&quot;: 20,
                &quot;name&quot;: &quot;Day Care Center Improvement&quot;,
                &quot;code&quot;: &quot;BRG3-EDU-001&quot;,
                &quot;allocated_amount&quot;: 257518,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 96,
            &quot;description&quot;: &quot;Transportation for Vaccination Program&quot;,
            &quot;amount&quot;: 7962,
            &quot;transaction_date&quot;: &quot;2026-02-28T00:00:00.000000Z&quot;,
            &quot;budget_item&quot;: {
                &quot;id&quot;: 19,
                &quot;name&quot;: &quot;Vaccination Program&quot;,
                &quot;code&quot;: &quot;BRG3-HEALTH-003&quot;,
                &quot;allocated_amount&quot;: 87074,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 100,
            &quot;description&quot;: &quot;Transportation for Vaccination Program&quot;,
            &quot;amount&quot;: 9781,
            &quot;transaction_date&quot;: &quot;2026-10-30T00:00:00.000000Z&quot;,
            &quot;budget_item&quot;: {
                &quot;id&quot;: 19,
                &quot;name&quot;: &quot;Vaccination Program&quot;,
                &quot;code&quot;: &quot;BRG3-HEALTH-003&quot;,
                &quot;allocated_amount&quot;: 87074,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 102,
            &quot;description&quot;: &quot;Materials Purchase for Vaccination Program&quot;,
            &quot;amount&quot;: 7490,
            &quot;transaction_date&quot;: &quot;2026-06-07T00:00:00.000000Z&quot;,
            &quot;budget_item&quot;: {
                &quot;id&quot;: 19,
                &quot;name&quot;: &quot;Vaccination Program&quot;,
                &quot;code&quot;: &quot;BRG3-HEALTH-003&quot;,
                &quot;allocated_amount&quot;: 87074,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 108,
            &quot;description&quot;: &quot;Professional Services for Day Care Center Improvement&quot;,
            &quot;amount&quot;: 12812,
            &quot;transaction_date&quot;: &quot;2026-04-29T00:00:00.000000Z&quot;,
            &quot;budget_item&quot;: {
                &quot;id&quot;: 20,
                &quot;name&quot;: &quot;Day Care Center Improvement&quot;,
                &quot;code&quot;: &quot;BRG3-EDU-001&quot;,
                &quot;allocated_amount&quot;: 257518,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 112,
            &quot;description&quot;: &quot;Equipment Rental for Learning Materials Purchase&quot;,
            &quot;amount&quot;: 7610,
            &quot;transaction_date&quot;: &quot;2026-12-15T00:00:00.000000Z&quot;,
            &quot;budget_item&quot;: {
                &quot;id&quot;: 21,
                &quot;name&quot;: &quot;Learning Materials Purchase&quot;,
                &quot;code&quot;: &quot;BRG3-EDU-002&quot;,
                &quot;allocated_amount&quot;: 93598,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 309,
            &quot;description&quot;: &quot;Transportation for Barangay Patrol Equipment&quot;,
            &quot;amount&quot;: 8779,
            &quot;transaction_date&quot;: &quot;2026-07-17T00:00:00.000000Z&quot;,
            &quot;budget_item&quot;: {
                &quot;id&quot;: 60,
                &quot;name&quot;: &quot;Barangay Patrol Equipment&quot;,
                &quot;code&quot;: &quot;BRG6-PEACE-002&quot;,
                &quot;allocated_amount&quot;: 106210,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 98,
            &quot;description&quot;: &quot;Labor Cost for Vaccination Program&quot;,
            &quot;amount&quot;: 6017,
            &quot;transaction_date&quot;: &quot;2026-04-07T00:00:00.000000Z&quot;,
            &quot;budget_item&quot;: {
                &quot;id&quot;: 19,
                &quot;name&quot;: &quot;Vaccination Program&quot;,
                &quot;code&quot;: &quot;BRG3-HEALTH-003&quot;,
                &quot;allocated_amount&quot;: 87074,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 97,
            &quot;description&quot;: &quot;Materials Purchase for Vaccination Program&quot;,
            &quot;amount&quot;: 6131,
            &quot;transaction_date&quot;: &quot;2026-11-15T00:00:00.000000Z&quot;,
            &quot;budget_item&quot;: {
                &quot;id&quot;: 19,
                &quot;name&quot;: &quot;Vaccination Program&quot;,
                &quot;code&quot;: &quot;BRG3-HEALTH-003&quot;,
                &quot;allocated_amount&quot;: 87074,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 106,
            &quot;description&quot;: &quot;Professional Services for Day Care Center Improvement&quot;,
            &quot;amount&quot;: 23721,
            &quot;transaction_date&quot;: &quot;2026-06-05T00:00:00.000000Z&quot;,
            &quot;budget_item&quot;: {
                &quot;id&quot;: 20,
                &quot;name&quot;: &quot;Day Care Center Improvement&quot;,
                &quot;code&quot;: &quot;BRG3-EDU-001&quot;,
                &quot;allocated_amount&quot;: 257518,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 107,
            &quot;description&quot;: &quot;Equipment Rental for Day Care Center Improvement&quot;,
            &quot;amount&quot;: 24146,
            &quot;transaction_date&quot;: &quot;2026-07-24T00:00:00.000000Z&quot;,
            &quot;budget_item&quot;: {
                &quot;id&quot;: 20,
                &quot;name&quot;: &quot;Day Care Center Improvement&quot;,
                &quot;code&quot;: &quot;BRG3-EDU-001&quot;,
                &quot;allocated_amount&quot;: 257518,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 99,
            &quot;description&quot;: &quot;Materials Purchase for Vaccination Program&quot;,
            &quot;amount&quot;: 9702,
            &quot;transaction_date&quot;: &quot;2026-01-02T00:00:00.000000Z&quot;,
            &quot;budget_item&quot;: {
                &quot;id&quot;: 19,
                &quot;name&quot;: &quot;Vaccination Program&quot;,
                &quot;code&quot;: &quot;BRG3-HEALTH-003&quot;,
                &quot;allocated_amount&quot;: 87074,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 111,
            &quot;description&quot;: &quot;Transportation for Learning Materials Purchase&quot;,
            &quot;amount&quot;: 14461,
            &quot;transaction_date&quot;: &quot;2026-12-22T00:00:00.000000Z&quot;,
            &quot;budget_item&quot;: {
                &quot;id&quot;: 21,
                &quot;name&quot;: &quot;Learning Materials Purchase&quot;,
                &quot;code&quot;: &quot;BRG3-EDU-002&quot;,
                &quot;allocated_amount&quot;: 93598,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 113,
            &quot;description&quot;: &quot;Transportation for Learning Materials Purchase&quot;,
            &quot;amount&quot;: 5033,
            &quot;transaction_date&quot;: &quot;2026-06-05T00:00:00.000000Z&quot;,
            &quot;budget_item&quot;: {
                &quot;id&quot;: 21,
                &quot;name&quot;: &quot;Learning Materials Purchase&quot;,
                &quot;code&quot;: &quot;BRG3-EDU-002&quot;,
                &quot;allocated_amount&quot;: 93598,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 101,
            &quot;description&quot;: &quot;Materials Purchase for Vaccination Program&quot;,
            &quot;amount&quot;: 9428,
            &quot;transaction_date&quot;: &quot;2026-04-20T00:00:00.000000Z&quot;,
            &quot;budget_item&quot;: {
                &quot;id&quot;: 19,
                &quot;name&quot;: &quot;Vaccination Program&quot;,
                &quot;code&quot;: &quot;BRG3-HEALTH-003&quot;,
                &quot;allocated_amount&quot;: 87074,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 105,
            &quot;description&quot;: &quot;Labor Cost for Day Care Center Improvement&quot;,
            &quot;amount&quot;: 19047,
            &quot;transaction_date&quot;: &quot;2026-02-28T00:00:00.000000Z&quot;,
            &quot;budget_item&quot;: {
                &quot;id&quot;: 20,
                &quot;name&quot;: &quot;Day Care Center Improvement&quot;,
                &quot;code&quot;: &quot;BRG3-EDU-001&quot;,
                &quot;allocated_amount&quot;: 257518,
                &quot;created_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-12-26T15:44:43.000000Z&quot;
            }
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://localhost:8000/api/v1/expenses?page=1&quot;,
        &quot;last&quot;: &quot;http://localhost:8000/api/v1/expenses?page=16&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: &quot;http://localhost:8000/api/v1/expenses?page=2&quot;
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 16,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:8000/api/v1/expenses?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;page&quot;: 1,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: &quot;http://localhost:8000/api/v1/expenses?page=2&quot;,
                &quot;label&quot;: &quot;2&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:8000/api/v1/expenses?page=3&quot;,
                &quot;label&quot;: &quot;3&quot;,
                &quot;page&quot;: 3,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:8000/api/v1/expenses?page=4&quot;,
                &quot;label&quot;: &quot;4&quot;,
                &quot;page&quot;: 4,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:8000/api/v1/expenses?page=5&quot;,
                &quot;label&quot;: &quot;5&quot;,
                &quot;page&quot;: 5,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:8000/api/v1/expenses?page=6&quot;,
                &quot;label&quot;: &quot;6&quot;,
                &quot;page&quot;: 6,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:8000/api/v1/expenses?page=7&quot;,
                &quot;label&quot;: &quot;7&quot;,
                &quot;page&quot;: 7,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:8000/api/v1/expenses?page=8&quot;,
                &quot;label&quot;: &quot;8&quot;,
                &quot;page&quot;: 8,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:8000/api/v1/expenses?page=9&quot;,
                &quot;label&quot;: &quot;9&quot;,
                &quot;page&quot;: 9,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:8000/api/v1/expenses?page=10&quot;,
                &quot;label&quot;: &quot;10&quot;,
                &quot;page&quot;: 10,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;...&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:8000/api/v1/expenses?page=15&quot;,
                &quot;label&quot;: &quot;15&quot;,
                &quot;page&quot;: 15,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:8000/api/v1/expenses?page=16&quot;,
                &quot;label&quot;: &quot;16&quot;,
                &quot;page&quot;: 16,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:8000/api/v1/expenses?page=2&quot;,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://localhost:8000/api/v1/expenses&quot;,
        &quot;per_page&quot;: 20,
        &quot;to&quot;: 20,
        &quot;total&quot;: 309
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-expenses" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-expenses"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-expenses"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-expenses" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-expenses">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-expenses" data-method="GET"
      data-path="api/v1/expenses"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-expenses', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-expenses"
                    onclick="tryItOut('GETapi-v1-expenses');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-expenses"
                    onclick="cancelTryOut('GETapi-v1-expenses');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-expenses"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/expenses</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-expenses"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-expenses"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization"                data-endpoint="GETapi-v1-expenses"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                        </form>

                    <h2 id="expenses-GETapi-v1-expenses--id-">Show expense</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-expenses--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/expenses/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Authorization: Bearer {YOUR_TOKEN}"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/expenses/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {YOUR_TOKEN}",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/expenses/1';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/expenses/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {YOUR_TOKEN}'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-expenses--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 59
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;description&quot;: &quot;Labor Cost for Basketball Court Renovation&quot;,
        &quot;amount&quot;: 17305,
        &quot;transaction_date&quot;: &quot;2026-06-18T00:00:00.000000Z&quot;,
        &quot;budget_item&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Basketball Court Renovation&quot;,
            &quot;code&quot;: &quot;BRG2-INFRA-001&quot;,
            &quot;allocated_amount&quot;: 402365,
            &quot;created_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-12-26T15:44:42.000000Z&quot;
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-expenses--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-expenses--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-expenses--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-expenses--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-expenses--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-expenses--id-" data-method="GET"
      data-path="api/v1/expenses/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-expenses--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-expenses--id-"
                    onclick="tryItOut('GETapi-v1-expenses--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-expenses--id-"
                    onclick="cancelTryOut('GETapi-v1-expenses--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-expenses--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/expenses/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-expenses--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-expenses--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization"                data-endpoint="GETapi-v1-expenses--id-"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-expenses--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the expense. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="expenses-POSTapi-v1-expenses">Create expense</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-expenses">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/expenses" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"budget_item_id\": 1,
    \"description\": \"Office supplies purchase\",
    \"amount\": 1500,
    \"transaction_date\": \"2024-01-15\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/expenses"
);

const headers = {
    "Authorization": "Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "budget_item_id": 1,
    "description": "Office supplies purchase",
    "amount": 1500,
    "transaction_date": "2024-01-15"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/expenses';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'budget_item_id' =&gt; 1,
            'description' =&gt; 'Office supplies purchase',
            'amount' =&gt; 1500.0,
            'transaction_date' =&gt; '2024-01-15',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/expenses'
payload = {
    "budget_item_id": 1,
    "description": "Office supplies purchase",
    "amount": 1500,
    "transaction_date": "2024-01-15"
}
headers = {
  'Authorization': 'Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-expenses">
</span>
<span id="execution-results-POSTapi-v1-expenses" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-expenses"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-expenses"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-expenses" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-expenses">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-expenses" data-method="POST"
      data-path="api/v1/expenses"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-expenses', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-expenses"
                    onclick="tryItOut('POSTapi-v1-expenses');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-expenses"
                    onclick="cancelTryOut('POSTapi-v1-expenses');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-expenses"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/expenses</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-expenses"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-expenses"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-expenses"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>budget_item_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="budget_item_id"                data-endpoint="POSTapi-v1-expenses"
               value="1"
               data-component="body">
    <br>
<p>Budget item ID. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-v1-expenses"
               value="Office supplies purchase"
               data-component="body">
    <br>
<p>Expense description. Example: <code>Office supplies purchase</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>amount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="amount"                data-endpoint="POSTapi-v1-expenses"
               value="1500"
               data-component="body">
    <br>
<p>Expense amount. Example: <code>1500</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>transaction_date</code></b>&nbsp;&nbsp;
<small>date</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="transaction_date"                data-endpoint="POSTapi-v1-expenses"
               value="2024-01-15"
               data-component="body">
    <br>
<p>Transaction date. Example: <code>2024-01-15</code></p>
        </div>
        </form>

                    <h2 id="expenses-PUTapi-v1-expenses--id-">Update expense</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-expenses--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/expenses/1" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"budget_item_id\": 15,
    \"description\": \"Purchase of office supplies for road maintenance\",
    \"amount\": 125000.5,
    \"transaction_date\": \"2025-03-15\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/expenses/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "budget_item_id": 15,
    "description": "Purchase of office supplies for road maintenance",
    "amount": 125000.5,
    "transaction_date": "2025-03-15"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/expenses/1';
$response = $client-&gt;put(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'budget_item_id' =&gt; 15,
            'description' =&gt; 'Purchase of office supplies for road maintenance',
            'amount' =&gt; 125000.5,
            'transaction_date' =&gt; '2025-03-15',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/expenses/1'
payload = {
    "budget_item_id": 15,
    "description": "Purchase of office supplies for road maintenance",
    "amount": 125000.5,
    "transaction_date": "2025-03-15"
}
headers = {
  'Authorization': 'Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-expenses--id-">
</span>
<span id="execution-results-PUTapi-v1-expenses--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-expenses--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-expenses--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-expenses--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-expenses--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-expenses--id-" data-method="PUT"
      data-path="api/v1/expenses/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-expenses--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-expenses--id-"
                    onclick="tryItOut('PUTapi-v1-expenses--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-expenses--id-"
                    onclick="cancelTryOut('PUTapi-v1-expenses--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-expenses--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/expenses/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/expenses/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-expenses--id-"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-expenses--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-expenses--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-expenses--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the expense. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>budget_item_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="budget_item_id"                data-endpoint="PUTapi-v1-expenses--id-"
               value="15"
               data-component="body">
    <br>
<p>ID of the budget item under which this expense is recorded. The <code>id</code> of an existing record in the budget_items table. Example: <code>15</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-v1-expenses--id-"
               value="Purchase of office supplies for road maintenance"
               data-component="body">
    <br>
<p>Updated brief description of the expense or transaction. Must not be greater than 255 characters. Example: <code>Purchase of office supplies for road maintenance</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>amount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="amount"                data-endpoint="PUTapi-v1-expenses--id-"
               value="125000.5"
               data-component="body">
    <br>
<p>Updated amount spent for this expense. Must be greater than zero. Must be at least 0.01. Example: <code>125000.5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>transaction_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="transaction_date"                data-endpoint="PUTapi-v1-expenses--id-"
               value="2025-03-15"
               data-component="body">
    <br>
<p>Updated date when the expense was incurred. Cannot be a future date. Must be a valid date. Must be a date before or equal to <code>today</code>. Example: <code>2025-03-15</code></p>
        </div>
        </form>

                    <h2 id="expenses-DELETEapi-v1-expenses--id-">Delete expense</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-expenses--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/expenses/1" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/expenses/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/expenses/1';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/expenses/1'
headers = {
  'Authorization': 'Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-expenses--id-">
</span>
<span id="execution-results-DELETEapi-v1-expenses--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-expenses--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-expenses--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-expenses--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-expenses--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-expenses--id-" data-method="DELETE"
      data-path="api/v1/expenses/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-expenses--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-expenses--id-"
                    onclick="tryItOut('DELETEapi-v1-expenses--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-expenses--id-"
                    onclick="cancelTryOut('DELETEapi-v1-expenses--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-expenses--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/expenses/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-expenses--id-"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-expenses--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-expenses--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-v1-expenses--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the expense. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="budget-categories">Budget Categories</h1>

    <p>Budget category management endpoints</p>

                                <h2 id="budget-categories-GETapi-v1-budget-categories">List budget categories</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-budget-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/budget-categories" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Authorization: Bearer {YOUR_TOKEN}"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/budget-categories"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {YOUR_TOKEN}",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/budget-categories';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/budget-categories'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {YOUR_TOKEN}'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-budget-categories">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-budget-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-budget-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-budget-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-budget-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-budget-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-budget-categories" data-method="GET"
      data-path="api/v1/budget-categories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-budget-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-budget-categories"
                    onclick="tryItOut('GETapi-v1-budget-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-budget-categories"
                    onclick="cancelTryOut('GETapi-v1-budget-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-budget-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/budget-categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-budget-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-budget-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization"                data-endpoint="GETapi-v1-budget-categories"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                        </form>

                    <h2 id="budget-categories-POSTapi-v1-budget-categories">Create budget category</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-budget-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/budget-categories" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Office Supplies\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/budget-categories"
);

const headers = {
    "Authorization": "Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Office Supplies"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/budget-categories';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'name' =&gt; 'Office Supplies',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/budget-categories'
payload = {
    "name": "Office Supplies"
}
headers = {
  'Authorization': 'Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-budget-categories">
</span>
<span id="execution-results-POSTapi-v1-budget-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-budget-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-budget-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-budget-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-budget-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-budget-categories" data-method="POST"
      data-path="api/v1/budget-categories"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-budget-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-budget-categories"
                    onclick="tryItOut('POSTapi-v1-budget-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-budget-categories"
                    onclick="cancelTryOut('POSTapi-v1-budget-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-budget-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/budget-categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-budget-categories"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-budget-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-budget-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-budget-categories"
               value="Office Supplies"
               data-component="body">
    <br>
<p>Category name. Example: <code>Office Supplies</code></p>
        </div>
        </form>

                    <h2 id="budget-categories-GETapi-v1-budget-categories--id-">Show budget category</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-budget-categories--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/budget-categories/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Authorization: Bearer {YOUR_TOKEN}"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/budget-categories/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {YOUR_TOKEN}",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/budget-categories/1';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/budget-categories/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {YOUR_TOKEN}'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-budget-categories--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-budget-categories--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-budget-categories--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-budget-categories--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-budget-categories--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-budget-categories--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-budget-categories--id-" data-method="GET"
      data-path="api/v1/budget-categories/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-budget-categories--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-budget-categories--id-"
                    onclick="tryItOut('GETapi-v1-budget-categories--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-budget-categories--id-"
                    onclick="cancelTryOut('GETapi-v1-budget-categories--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-budget-categories--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/budget-categories/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-budget-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-budget-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization"                data-endpoint="GETapi-v1-budget-categories--id-"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-budget-categories--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the budget category. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="budget-categories-PUTapi-v1-budget-categories--id-">Update budget category</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-budget-categories--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/budget-categories/1" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Office Equipment\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/budget-categories/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Office Equipment"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/budget-categories/1';
$response = $client-&gt;put(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'name' =&gt; 'Office Equipment',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/budget-categories/1'
payload = {
    "name": "Office Equipment"
}
headers = {
  'Authorization': 'Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-budget-categories--id-">
</span>
<span id="execution-results-PUTapi-v1-budget-categories--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-budget-categories--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-budget-categories--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-budget-categories--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-budget-categories--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-budget-categories--id-" data-method="PUT"
      data-path="api/v1/budget-categories/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-budget-categories--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-budget-categories--id-"
                    onclick="tryItOut('PUTapi-v1-budget-categories--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-budget-categories--id-"
                    onclick="cancelTryOut('PUTapi-v1-budget-categories--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-budget-categories--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/budget-categories/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/budget-categories/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-budget-categories--id-"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-budget-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-budget-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-budget-categories--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the budget category. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-v1-budget-categories--id-"
               value="Office Equipment"
               data-component="body">
    <br>
<p>Category name. Example: <code>Office Equipment</code></p>
        </div>
        </form>

                    <h2 id="budget-categories-DELETEapi-v1-budget-categories--id-">Delete budget category</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-budget-categories--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/budget-categories/1" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/budget-categories/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/budget-categories/1';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/budget-categories/1'
headers = {
  'Authorization': 'Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-budget-categories--id-">
</span>
<span id="execution-results-DELETEapi-v1-budget-categories--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-budget-categories--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-budget-categories--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-budget-categories--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-budget-categories--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-budget-categories--id-" data-method="DELETE"
      data-path="api/v1/budget-categories/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-budget-categories--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-budget-categories--id-"
                    onclick="tryItOut('DELETEapi-v1-budget-categories--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-budget-categories--id-"
                    onclick="cancelTryOut('DELETEapi-v1-budget-categories--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-budget-categories--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/budget-categories/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-budget-categories--id-"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-budget-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-budget-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-v1-budget-categories--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the budget category. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="fiscal-years">Fiscal Years</h1>

    <p>Fiscal year management endpoints</p>

                                <h2 id="fiscal-years-GETapi-v1-fiscal-years">List fiscal years</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-fiscal-years">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/fiscal-years" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Authorization: Bearer {YOUR_TOKEN}"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/fiscal-years"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {YOUR_TOKEN}",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/fiscal-years';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/fiscal-years'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {YOUR_TOKEN}'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-fiscal-years">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-fiscal-years" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-fiscal-years"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-fiscal-years"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-fiscal-years" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-fiscal-years">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-fiscal-years" data-method="GET"
      data-path="api/v1/fiscal-years"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-fiscal-years', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-fiscal-years"
                    onclick="tryItOut('GETapi-v1-fiscal-years');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-fiscal-years"
                    onclick="cancelTryOut('GETapi-v1-fiscal-years');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-fiscal-years"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/fiscal-years</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-fiscal-years"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-fiscal-years"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization"                data-endpoint="GETapi-v1-fiscal-years"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                        </form>

                    <h2 id="fiscal-years-POSTapi-v1-fiscal-years">Create fiscal year</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-fiscal-years">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/fiscal-years" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"year\": 2024,
    \"start_date\": \"2024-01-01\",
    \"end_date\": \"2024-12-31\",
    \"is_active\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/fiscal-years"
);

const headers = {
    "Authorization": "Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "year": 2024,
    "start_date": "2024-01-01",
    "end_date": "2024-12-31",
    "is_active": true
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/fiscal-years';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'year' =&gt; 2024,
            'start_date' =&gt; '2024-01-01',
            'end_date' =&gt; '2024-12-31',
            'is_active' =&gt; true,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/fiscal-years'
payload = {
    "year": 2024,
    "start_date": "2024-01-01",
    "end_date": "2024-12-31",
    "is_active": true
}
headers = {
  'Authorization': 'Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-fiscal-years">
</span>
<span id="execution-results-POSTapi-v1-fiscal-years" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-fiscal-years"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-fiscal-years"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-fiscal-years" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-fiscal-years">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-fiscal-years" data-method="POST"
      data-path="api/v1/fiscal-years"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-fiscal-years', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-fiscal-years"
                    onclick="tryItOut('POSTapi-v1-fiscal-years');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-fiscal-years"
                    onclick="cancelTryOut('POSTapi-v1-fiscal-years');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-fiscal-years"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/fiscal-years</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-fiscal-years"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-fiscal-years"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-fiscal-years"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>year</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="year"                data-endpoint="POSTapi-v1-fiscal-years"
               value="2024"
               data-component="body">
    <br>
<p>Fiscal year. Example: <code>2024</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>start_date</code></b>&nbsp;&nbsp;
<small>date</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="start_date"                data-endpoint="POSTapi-v1-fiscal-years"
               value="2024-01-01"
               data-component="body">
    <br>
<p>Start date. Example: <code>2024-01-01</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>end_date</code></b>&nbsp;&nbsp;
<small>date</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="end_date"                data-endpoint="POSTapi-v1-fiscal-years"
               value="2024-12-31"
               data-component="body">
    <br>
<p>End date. Example: <code>2024-12-31</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-fiscal-years" style="display: none">
            <input type="radio" name="is_active"
                   value="true"
                   data-endpoint="POSTapi-v1-fiscal-years"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-fiscal-years" style="display: none">
            <input type="radio" name="is_active"
                   value="false"
                   data-endpoint="POSTapi-v1-fiscal-years"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Active status. Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="fiscal-years-GETapi-v1-fiscal-years--id-">Show fiscal year</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-fiscal-years--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/fiscal-years/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Authorization: Bearer {YOUR_TOKEN}"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/fiscal-years/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {YOUR_TOKEN}",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/fiscal-years/1';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/fiscal-years/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {YOUR_TOKEN}'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-fiscal-years--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-fiscal-years--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-fiscal-years--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-fiscal-years--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-fiscal-years--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-fiscal-years--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-fiscal-years--id-" data-method="GET"
      data-path="api/v1/fiscal-years/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-fiscal-years--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-fiscal-years--id-"
                    onclick="tryItOut('GETapi-v1-fiscal-years--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-fiscal-years--id-"
                    onclick="cancelTryOut('GETapi-v1-fiscal-years--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-fiscal-years--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/fiscal-years/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-fiscal-years--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-fiscal-years--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization"                data-endpoint="GETapi-v1-fiscal-years--id-"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-fiscal-years--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the fiscal year. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="fiscal-years-PUTapi-v1-fiscal-years--id-">Update fiscal year</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-fiscal-years--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/fiscal-years/1" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"year\": 2025,
    \"start_date\": \"2025-01-01\",
    \"end_date\": \"2025-12-31\",
    \"is_active\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/fiscal-years/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "year": 2025,
    "start_date": "2025-01-01",
    "end_date": "2025-12-31",
    "is_active": false
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/fiscal-years/1';
$response = $client-&gt;put(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'year' =&gt; 2025,
            'start_date' =&gt; '2025-01-01',
            'end_date' =&gt; '2025-12-31',
            'is_active' =&gt; false,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/fiscal-years/1'
payload = {
    "year": 2025,
    "start_date": "2025-01-01",
    "end_date": "2025-12-31",
    "is_active": false
}
headers = {
  'Authorization': 'Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-fiscal-years--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Fiscal year updated successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;year&quot;: 2024,
        &quot;start_date&quot;: &quot;2024-01-01&quot;,
        &quot;end_date&quot;: &quot;2024-12-31&quot;,
        &quot;is_active&quot;: true
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-v1-fiscal-years--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-fiscal-years--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-fiscal-years--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-fiscal-years--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-fiscal-years--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-fiscal-years--id-" data-method="PUT"
      data-path="api/v1/fiscal-years/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-fiscal-years--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-fiscal-years--id-"
                    onclick="tryItOut('PUTapi-v1-fiscal-years--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-fiscal-years--id-"
                    onclick="cancelTryOut('PUTapi-v1-fiscal-years--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-fiscal-years--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/fiscal-years/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/fiscal-years/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-fiscal-years--id-"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-fiscal-years--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-fiscal-years--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-fiscal-years--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the fiscal year. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>year</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="year"                data-endpoint="PUTapi-v1-fiscal-years--id-"
               value="2025"
               data-component="body">
    <br>
<p>Updated fiscal year as a four-digit calendar year. Must be unique. Must be at least 1900. Example: <code>2025</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>start_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="start_date"                data-endpoint="PUTapi-v1-fiscal-years--id-"
               value="2025-01-01"
               data-component="body">
    <br>
<p>Updated start date of the fiscal year. Must be a valid date. Example: <code>2025-01-01</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>end_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="end_date"                data-endpoint="PUTapi-v1-fiscal-years--id-"
               value="2025-12-31"
               data-component="body">
    <br>
<p>Updated end date of the fiscal year. Must be after the start date. Must be a valid date. Must be a date after <code>start_date</code>. Example: <code>2025-12-31</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-v1-fiscal-years--id-" style="display: none">
            <input type="radio" name="is_active"
                   value="true"
                   data-endpoint="PUTapi-v1-fiscal-years--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-fiscal-years--id-" style="display: none">
            <input type="radio" name="is_active"
                   value="false"
                   data-endpoint="PUTapi-v1-fiscal-years--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Indicates whether this fiscal year is currently active. Example: <code>false</code></p>
        </div>
        </form>

                    <h2 id="fiscal-years-DELETEapi-v1-fiscal-years--id-">Delete fiscal year</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-fiscal-years--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/fiscal-years/1" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/fiscal-years/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/fiscal-years/1';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/fiscal-years/1'
headers = {
  'Authorization': 'Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-fiscal-years--id-">
</span>
<span id="execution-results-DELETEapi-v1-fiscal-years--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-fiscal-years--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-fiscal-years--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-fiscal-years--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-fiscal-years--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-fiscal-years--id-" data-method="DELETE"
      data-path="api/v1/fiscal-years/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-fiscal-years--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-fiscal-years--id-"
                    onclick="tryItOut('DELETEapi-v1-fiscal-years--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-fiscal-years--id-"
                    onclick="cancelTryOut('DELETEapi-v1-fiscal-years--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-fiscal-years--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/fiscal-years/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-fiscal-years--id-"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-fiscal-years--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-fiscal-years--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-v1-fiscal-years--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the fiscal year. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="users">Users</h1>

    <p>User management endpoints</p>

                                <h2 id="users-GETapi-v1-users">List users</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-users">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/users" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/users"
);

const headers = {
    "Authorization": "Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/users';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/users'
headers = {
  'Authorization': 'Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-users">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-users"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-users">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-users" data-method="GET"
      data-path="api/v1/users"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-users"
                    onclick="tryItOut('GETapi-v1-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-users"
                    onclick="cancelTryOut('GETapi-v1-users');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-users"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/users</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-users"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="users-POSTapi-v1-users">Create user</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-users">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/users" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Jane Doe\",
    \"email\": \"jane@example.com\",
    \"password\": \"password123\",
    \"role\": \"admin\",
    \"password_confirmation\": \"password123\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/users"
);

const headers = {
    "Authorization": "Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Jane Doe",
    "email": "jane@example.com",
    "password": "password123",
    "role": "admin",
    "password_confirmation": "password123"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/users';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'name' =&gt; 'Jane Doe',
            'email' =&gt; 'jane@example.com',
            'password' =&gt; 'password123',
            'role' =&gt; 'admin',
            'password_confirmation' =&gt; 'password123',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/users'
payload = {
    "name": "Jane Doe",
    "email": "jane@example.com",
    "password": "password123",
    "role": "admin",
    "password_confirmation": "password123"
}
headers = {
  'Authorization': 'Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-users">
</span>
<span id="execution-results-POSTapi-v1-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-users"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-users">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-users" data-method="POST"
      data-path="api/v1/users"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-users"
                    onclick="tryItOut('POSTapi-v1-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-users"
                    onclick="cancelTryOut('POSTapi-v1-users');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-users"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/users</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-users"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-users"
               value="Jane Doe"
               data-component="body">
    <br>
<p>User's full name. Example: <code>Jane Doe</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-users"
               value="jane@example.com"
               data-component="body">
    <br>
<p>User's email. Example: <code>jane@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-users"
               value="password123"
               data-component="body">
    <br>
<p>Password. Example: <code>password123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>role</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="role"                data-endpoint="POSTapi-v1-users"
               value="admin"
               data-component="body">
    <br>
<p>User role. Example: <code>admin</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password_confirmation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password_confirmation"                data-endpoint="POSTapi-v1-users"
               value="password123"
               data-component="body">
    <br>
<p>Confirm password. Example: <code>password123</code></p>
        </div>
        </form>

                    <h2 id="users-GETapi-v1-users--id-">Show user</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-users--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/users/1" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/users/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/users/1';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/users/1'
headers = {
  'Authorization': 'Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-users--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-users--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-users--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-users--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-users--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-users--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-users--id-" data-method="GET"
      data-path="api/v1/users/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-users--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-users--id-"
                    onclick="tryItOut('GETapi-v1-users--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-users--id-"
                    onclick="cancelTryOut('GETapi-v1-users--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-users--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/users/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-users--id-"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-users--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="users-PUTapi-v1-users--id-">Update user</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-users--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/users/1" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Jane Doe\",
    \"email\": \"jane@example.com\",
    \"password\": \"password123\",
    \"role\": \"admin\",
    \"password_confirmation\": \"password123\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/users/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Jane Doe",
    "email": "jane@example.com",
    "password": "password123",
    "role": "admin",
    "password_confirmation": "password123"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/users/1';
$response = $client-&gt;put(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'name' =&gt; 'Jane Doe',
            'email' =&gt; 'jane@example.com',
            'password' =&gt; 'password123',
            'role' =&gt; 'admin',
            'password_confirmation' =&gt; 'password123',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/users/1'
payload = {
    "name": "Jane Doe",
    "email": "jane@example.com",
    "password": "password123",
    "role": "admin",
    "password_confirmation": "password123"
}
headers = {
  'Authorization': 'Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-users--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;User updated successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Jane Doe&quot;,
        &quot;email&quot;: &quot;jane@example.com&quot;,
        &quot;role&quot;: &quot;admin&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-v1-users--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-users--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-users--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-users--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-users--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-users--id-" data-method="PUT"
      data-path="api/v1/users/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-users--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-users--id-"
                    onclick="tryItOut('PUTapi-v1-users--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-users--id-"
                    onclick="cancelTryOut('PUTapi-v1-users--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-users--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/users/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/users/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-users--id-"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-users--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-v1-users--id-"
               value="Jane Doe"
               data-component="body">
    <br>
<p>User's full name. Example: <code>Jane Doe</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTapi-v1-users--id-"
               value="jane@example.com"
               data-component="body">
    <br>
<p>User's email. Example: <code>jane@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="PUTapi-v1-users--id-"
               value="password123"
               data-component="body">
    <br>
<p>Password. Example: <code>password123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>role</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="role"                data-endpoint="PUTapi-v1-users--id-"
               value="admin"
               data-component="body">
    <br>
<p>User role. Example: <code>admin</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password_confirmation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password_confirmation"                data-endpoint="PUTapi-v1-users--id-"
               value="password123"
               data-component="body">
    <br>
<p>Confirm password (required if password is provided). Example: <code>password123</code></p>
        </div>
        </form>

                    <h2 id="users-DELETEapi-v1-users--id-">Delete user</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-users--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/users/1" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/users/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/users/1';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/users/1'
headers = {
  'Authorization': 'Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-users--id-">
</span>
<span id="execution-results-DELETEapi-v1-users--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-users--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-users--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-users--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-users--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-users--id-" data-method="DELETE"
      data-path="api/v1/users/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-users--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-users--id-"
                    onclick="tryItOut('DELETEapi-v1-users--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-users--id-"
                    onclick="cancelTryOut('DELETEapi-v1-users--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-users--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/users/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-users--id-"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-v1-users--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="government-units">Government Units  </h1>

    <p>Government unit management endpoints</p>

                                <h2 id="government-units-GETapi-v1-government-units">List government units</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-government-units">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/government-units" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Authorization: Bearer {YOUR_TOKEN}"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/government-units"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {YOUR_TOKEN}",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/government-units';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/government-units'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {YOUR_TOKEN}'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-government-units">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-government-units" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-government-units"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-government-units"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-government-units" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-government-units">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-government-units" data-method="GET"
      data-path="api/v1/government-units"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-government-units', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-government-units"
                    onclick="tryItOut('GETapi-v1-government-units');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-government-units"
                    onclick="cancelTryOut('GETapi-v1-government-units');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-government-units"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/government-units</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-government-units"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-government-units"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization"                data-endpoint="GETapi-v1-government-units"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                        </form>

                    <h2 id="government-units-POSTapi-v1-government-units">Create government unit</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-government-units">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/government-units" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Department of Finance\",
    \"type\": \"department\",
    \"parent_id\": 1
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/government-units"
);

const headers = {
    "Authorization": "Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Department of Finance",
    "type": "department",
    "parent_id": 1
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/government-units';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'name' =&gt; 'Department of Finance',
            'type' =&gt; 'department',
            'parent_id' =&gt; 1,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/government-units'
payload = {
    "name": "Department of Finance",
    "type": "department",
    "parent_id": 1
}
headers = {
  'Authorization': 'Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-government-units">
</span>
<span id="execution-results-POSTapi-v1-government-units" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-government-units"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-government-units"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-government-units" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-government-units">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-government-units" data-method="POST"
      data-path="api/v1/government-units"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-government-units', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-government-units"
                    onclick="tryItOut('POSTapi-v1-government-units');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-government-units"
                    onclick="cancelTryOut('POSTapi-v1-government-units');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-government-units"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/government-units</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-government-units"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-government-units"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-government-units"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-government-units"
               value="Department of Finance"
               data-component="body">
    <br>
<p>Unit name. Example: <code>Department of Finance</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="POSTapi-v1-government-units"
               value="department"
               data-component="body">
    <br>
<p>Unit type. Example: <code>department</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>parent_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="parent_id"                data-endpoint="POSTapi-v1-government-units"
               value="1"
               data-component="body">
    <br>
<p>Parent unit ID. Example: <code>1</code></p>
        </div>
        </form>

                    <h2 id="government-units-GETapi-v1-government-units--id-">Show government unit</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-government-units--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/government-units/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Authorization: Bearer {YOUR_TOKEN}"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/government-units/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {YOUR_TOKEN}",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/government-units/1';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/government-units/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {YOUR_TOKEN}'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-government-units--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-government-units--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-government-units--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-government-units--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-government-units--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-government-units--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-government-units--id-" data-method="GET"
      data-path="api/v1/government-units/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-government-units--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-government-units--id-"
                    onclick="tryItOut('GETapi-v1-government-units--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-government-units--id-"
                    onclick="cancelTryOut('GETapi-v1-government-units--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-government-units--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/government-units/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-government-units--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-government-units--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization"                data-endpoint="GETapi-v1-government-units--id-"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-government-units--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the government unit. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="government-units-PUTapi-v1-government-units--id-">Update government unit</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-government-units--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/government-units/1" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Department of Transportation\",
    \"type\": \"Department\",
    \"parent_id\": 1
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/government-units/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Department of Transportation",
    "type": "Department",
    "parent_id": 1
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/government-units/1';
$response = $client-&gt;put(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'name' =&gt; 'Department of Transportation',
            'type' =&gt; 'Department',
            'parent_id' =&gt; 1,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/government-units/1'
payload = {
    "name": "Department of Transportation",
    "type": "Department",
    "parent_id": 1
}
headers = {
  'Authorization': 'Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-government-units--id-">
</span>
<span id="execution-results-PUTapi-v1-government-units--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-government-units--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-government-units--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-government-units--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-government-units--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-government-units--id-" data-method="PUT"
      data-path="api/v1/government-units/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-government-units--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-government-units--id-"
                    onclick="tryItOut('PUTapi-v1-government-units--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-government-units--id-"
                    onclick="cancelTryOut('PUTapi-v1-government-units--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-government-units--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/government-units/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/government-units/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-government-units--id-"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-government-units--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-government-units--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-government-units--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the government unit. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-v1-government-units--id-"
               value="Department of Transportation"
               data-component="body">
    <br>
<p>Updated official name of the government unit. Must not be greater than 255 characters. Example: <code>Department of Transportation</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="PUTapi-v1-government-units--id-"
               value="Department"
               data-component="body">
    <br>
<p>Updated type or classification of the government unit. Must not be greater than 100 characters. Example: <code>Department</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>parent_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="parent_id"                data-endpoint="PUTapi-v1-government-units--id-"
               value="1"
               data-component="body">
    <br>
<p>ID of the parent government unit, if this unit is part of a hierarchical structure. Can be null. The <code>id</code> of an existing record in the government_units table. Example: <code>1</code></p>
        </div>
        </form>

                    <h2 id="government-units-DELETEapi-v1-government-units--id-">Delete government unit</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-government-units--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/government-units/1" \
    --header "Authorization: Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/government-units/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/government-units/1';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/government-units/1'
headers = {
  'Authorization': 'Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-government-units--id-">
</span>
<span id="execution-results-DELETEapi-v1-government-units--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-government-units--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-government-units--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-government-units--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-government-units--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-government-units--id-" data-method="DELETE"
      data-path="api/v1/government-units/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-government-units--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-government-units--id-"
                    onclick="tryItOut('DELETEapi-v1-government-units--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-government-units--id-"
                    onclick="cancelTryOut('DELETEapi-v1-government-units--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-government-units--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/government-units/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-government-units--id-"
               value="Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-government-units--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-government-units--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-v1-government-units--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the government unit. Example: <code>1</code></p>
            </div>
                    </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                                                        <button type="button" class="lang-button" data-language-name="php">php</button>
                                                        <button type="button" class="lang-button" data-language-name="python">python</button>
                            </div>
            </div>
</div>
</body>
</html>
