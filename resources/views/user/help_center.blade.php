@extends('_layouts.user')

@section('content')
<div class="container mt-5">
    <!-- Help Center Header -->
    <div class="row">
        <div class="col-12">
            <h3>Help Center</h3>
            <p>Find answers to common questions or contact support if you need further assistance.</p>
        </div>
    </div>

    <!-- FAQ Section -->
    <h4>Frequently Asked Questions (FAQ)</h4>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <p class="lead fw-bold m-0">1.) How do I Create a Ticket?</p>
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    To create a ticket, click on the <a href="{{ route('userCreateTicket') }}">Create Ticket</a> tab in the sidebar, fill in the required details, and submit your request.
                </div>
            </div>
        </div>
    
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <p class="lead fw-bold m-0">2.) How can I track my Ticket Status?</p>
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    If you recently submitted your ticket, you can view it in the <a href="{{ route('userHome') }}">Dashboard</a> and see it's status. Otherwise you can just go to <a href="{{ route('userHistory') }}">History</a> tab and search the date where you submitted your ticket.
                </div>
            </div>
        </div>
    
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <p class="lead fw-bold m-0">3.) What do I do if my Ticket is not getting Resolved?</p>
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    If your ticket is not getting resolved after a considerable amount of time. You can notify MIS directly via calling 201 or 277 in our local phone directory. Don't forget to inform MIS of the ticket number and the date it was submitted.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    <p class="lead fw-bold m-0">4.) Will my existing Job Tickets reflect when my account is unauthorized?</p>
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    No. If by chance your account has Job tickets and has lost authorization access in the website. Then your tickets won't reflect and show in the server. But rest assured that your tickets are not deleted, it's just not showing. Only authorized accounts has the ability to reflect in our server side. Reach out to MIS if ever your account has lost its authorization access.
                </div>
            </div>
        </div>
        
    </div>
    

    <!-- Troubleshooting Tips Section -->
    <div class="row mt-4">
        <div class="col-12">
            <h4>Other Problems:</h4>
            <ul class="list-group">
                <li class="list-group-item">
                    <strong>Network Issues</strong> - If you're experiencing network issues, please contact MIS for assistance.
                </li>
                <li class="list-group-item">
                    <strong>Login Problems</strong> - Ensure that your username and password are correct. If you’ve forgotten your password please contact MIS along with your ID number, First Name, and Last Name.
                </li>
            </ul>
        </div>
    </div>

    <!-- Contact Support Section -->
    <div class="row mt-4">
        <div class="col-12">
            <h4>Contact Support</h4>
			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum officiis harum ipsam, sit fugit velit autem unde neque dolore commodi quod? Voluptatum velit maiores tempore dicta, dolore quae vero nulla.</p>
			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium quas deleniti voluptatibus, sed sit quam possimus ipsa cupiditate repudiandae consequuntur quae maxime nam quasi, consectetur autem! Nisi officiis eos molestias?</p>
		</div>
    </div>
</div>
@endsection
