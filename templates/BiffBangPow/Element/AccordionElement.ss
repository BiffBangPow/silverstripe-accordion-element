<div class="container">
    <% if $Title && $ShowTitle %>
        <div class="row">
            <div class="col-12">
                <h2>$Title.XML</h2>
            </div>
        </div>
    <% end_if %>

    <% if $Content %>
        <div class="row mt-4">
            <div class="col-12">
                $Content
            </div>
        </div>
    <% end_if %>

    <div class="accordion mt-4" id="accordionElement{$ID}">
        <% loop $Items %>
            <details<% if $OpenOnLoad %> open<% end_if %>>
                <summary class="py-4">$Title</summary>
                <div class="accordion-content px-5 pb-4">
                    $Content
                    <% if $CTAType != 'None' %>
                        <div class="accordion-cta my-3">
                            <p>
                                <a href="$CTALink" class="cta-link btn btn-outline-primary"
                                    <% if $CTAType == 'External' %>target="_blank" rel="noopener"
                                    <% else_if $CTAType == 'Download' %>download
                                    <% end_if %>>
                                    $LinkText
                                </a>
                            </p>
                        </div>
                    <% end_if %>
                </div>
            </details>
        <% end_loop %>
    </div>


</div>

