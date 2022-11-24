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
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{$ID}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{$ID}" aria-expanded="true" aria-controls="collapse{$ID}">
                        $Title
                    </button>
                </h2>
                <div id="collapse{$ID}" class="accordion-collapse collapse show" aria-labelledby="heading{$ID}"
                     data-bs-parent="#accordion{$Up.ID}">
                    <div class="accordion-body">
                        $Content
                        <% if $CTAType != 'None' %>
                            <div class="column-cta">
                                <p>
                                    <a href="$CTALink" class="cta-link btn btn-secondary"
                                        <% if $CTAType == 'External' %>target="_blank" rel="noopener"
                                        <% else_if $CTAType == 'Download' %>download
                                        <% end_if %>>
                                        $LinkText
                                    </a>
                                </p>
                            </div>
                        <% end_if %>
                    </div>
                </div>
            </div>
        <% end_loop %>
    </div>


</div>

