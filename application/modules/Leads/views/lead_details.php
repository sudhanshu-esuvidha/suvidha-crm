<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<?php $this->load->view('Template/head',$data); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
	.floating-btn {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 60px;
    height: 60px;
    background-color: #011c55; /* blue color, you can change */
    color: #fff;
    border-radius: 50%;
    text-align: center;
    line-height: 60px;
    font-size: 28px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.3);
    z-index: 9999;
    transition: background-color 0.3s;
}

.floating-btn:hover {
    background-color: #0056b3;
    text-decoration: none;
    color: #fff;
}
.whatsapp-box {
    position: fixed;
    bottom: 20px;
    right: 20px;
    height:200px;
    width: 280px;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 12px;
    padding: 10px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.2);
    z-index: 9999;
    display: flex;
    flex-direction: column;
}

.whatsapp-box textarea {
    width: 100%;
    height: 80px;
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 8px;
    font-size: 14px;
    resize: none;
    margin-bottom: 8px;
}

.whatsapp-box .send-btn {
    background-color: #25d366;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 6px 12px;
    font-size: 14px;
    cursor: pointer;
}

.whatsapp-box .close-btn {
    background: transparent;
    border: none;
    color: #888;
    font-size: 16px;
    cursor: pointer;
}

.whatsapp-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: bold;
    margin-bottom: 5px;
    cursor: move;
}

</style>
<body>
	<?php  $date=date("Y-m-d");
	$date2=date('Y-m-d', strtotime($date.' + 1 day')); ?>
	<div class="main-wrapper">
		<div class="header">
			<?php $this->load->view('Template/header',$data); ?>
			<div class="page-wrapper">
				<div class="content container-fluid pb-0">
				    	<?php $this->load->view('Template/page_header',$data); ?>
					<div class="row">
						<div class="col-md-12">
							<div class="card1 mb-0">
								<div class="card-body1">
									<div class="row">
										<div class="col-md-12">
											<div class="col-xxl-12 col-lg-12 col-md-12 d-flex">
	<div class="card flex-fill">
		<div class="card-body">

			<div class="notification-tab">
				<ul class="nav nav-tabs" role="tablist">
					<li>
						<a href="#" class="active" data-bs-toggle="tab" data-bs-target="#notification_tab" aria-selected="true" role="tab" style="font-size:16px;">
							<i class="la la-bell"></i> Details
						</a>
					</li>
					<li>
						<a href="#" data-bs-toggle="tab" data-bs-target="#schedule_tab" aria-selected="false" tabindex="-1" role="tab" style="font-size:16px;">
							<i class="la la-list-alt"></i>  History
						</a>
					</li>
				</ul>
                <?php if($this->session->flashdata('success')): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= $this->session->flashdata('success'); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>



				<div class="tab-content">
					<div class="tab-pane active" id="notification_tab" role="tabpanel">
						<div class="employee-noti-content">
							<div class="profile-view">
												<!--<div class="profile-img-wrap">-->
												<!--	<div class="profile-img">-->
												<!--		<a href="#"><img src="assets/img/profiles/avatar-02.jpg" alt="User Image"></a>-->
												<!--	</div>-->
												<!--</div>-->
												<div class="profile-basic">
													<div class="row">
														<div class="col-md-5">
															<div class="profile-info-left">
																<h3 class="user-name m-t-0 mb-0"><?php echo ucwords($data->contact_name); ?></h3>
																<h6 class="text-muted"><?php echo ucwords($data->address); ?></h6>
																
																<div class="staff-id">Course : <?php echo ucwords($data->description); ?></div>
																<div class="small doj text-muted">Date  Created : <?php echo date("d M Y h:i a",strtotime($data->created_at));  ?></div>
																<div class="staff-msg">
																   <!-- Make Call Button -->
<button type="button" class="btn btn-custom" onclick="openCallBox('<?php echo $data->mobile_no; ?>','<?php echo !empty($data->add_mobile_no) ? $data->add_mobile_no : ''; ?>')">
    <i class="la la-phone-volume"></i> Make Call
</button>

<!-- Call Selection Modal -->
<div class="modal fade" id="callModal" tabindex="-1" aria-labelledby="callModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="callModalLabel">Select Number to Call</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <select id="callSelectNumber" class="form-select mb-3">
          <!-- Options will be populated dynamically -->
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="makeCall()">Call</button>
      </div>
    </div>
  </div>
</div>

<script>
let callNumbers = [];

function openCallBox(mainNumber, addNumbers) {
    callNumbers = [mainNumber];
    if(addNumbers) {
        const extraNumbers = addNumbers.split(',').map(num => num.trim()).filter(Boolean);
        callNumbers = callNumbers.concat(extraNumbers);
    }

    const select = document.getElementById("callSelectNumber");
    select.innerHTML = '';
    callNumbers.forEach(num => {
        const option = document.createElement('option');
        option.value = num;
        option.textContent = num;
        select.appendChild(option);
    });

    const modal = new bootstrap.Modal(document.getElementById('callModal'));
    modal.show();
}

function makeCall() {
    const selectedNumber = document.getElementById("callSelectNumber").value;
    window.location.href = "tel:" + selectedNumber;
}
</script>
<!-- WhatsApp Button -->
<button type="button" class="btn btn-success" onclick="openWhatsAppBox('<?php echo $data->mobile_no; ?>','<?php echo !empty($data->add_mobile_no) ? $data->add_mobile_no : ''; ?>')">
    <i class="la la-whatsapp"></i> WhatsApp
</button>

<!-- Draggable WhatsApp Box -->
<div id="whatsappBox" class="whatsapp-box" style="display:none;">
    <div id="whatsappHeader" class="whatsapp-header">
        <span>Send WhatsApp Message</span>
        <button class="close-btn" onclick="closeWhatsAppBox()">✕</button>
    </div>

    <div class="mb-2">
        <select id="whatsappSelectNumber" class="form-select form-select-sm">
            <!-- Options will be populated dynamically -->
        </select>
    </div>

    <textarea id="whatsappMessage" placeholder="Type your message..."></textarea>
    <button class="send-btn" onclick="sendWhatsApp()">Send</button>
</div>
                                                                </div>
															</div>
														</div>
														<div class="col-md-7">
															<ul class="personal-info" >
																<li>
    <div class="title">Phone:</div>
    <div class="text">
        <?php
        // Start with main mobile number
        $numbers = [$data->mobile_no];

        // Add additional numbers if present
        if (!empty($data->add_mobile_no)) {
            $extraNumbers = explode(',', $data->add_mobile_no);
            $extraNumbers = array_map('trim', $extraNumbers); // remove spaces
            $numbers = array_merge($numbers, $extraNumbers);
        }

        // Display all numbers, separated by comma
        echo implode(', ', $numbers);
        ?>
    </div>
</li>

																<li>
																	<div class="title">Email:</div>
																	<div class="text"><?php echo $data->email; ?></div>
																</li>
															
																<li>
																	<div class="title">Address:</div>
																	<div class="text"><?php echo ucwords($data->address); ?></div>
																</li>
																
																<li>
																	<div class="title">Assign to:</div>
																	<div class="text">
																		
																		
																			<?php $assign_to=get_row('users',' where id='.$data->assign_to); echo ucwords($assign_to->name); ?>
																		
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</div>
<div class="pro-edit">
    <!-- Add Number Icon -->
    <a href="#" class="edit-icon text-success" data-bs-toggle="modal" data-bs-target="#addNumberModal">
        <i class="fa-solid fa-circle-plus" style="font-size: 28px;"></i>
    </a>

    <!-- Edit Pencil Icon -->
</div>
<style>
.fon {
    font-size: 28px; /* increase as needed */
}
</style>


                                            </div>
						</div>
					</div>
				<div class="tab-pane fade" id="schedule_tab" role="tabpanel">
    <div class="employee-noti-content">

        <!-- Show contact info at top -->
<div class="contact-info d-flex justify-content-between align-items-center">
    <!-- Left: Name -->
    <span><strong><?php echo ucwords($data->contact_name); ?></strong></span>

    <!-- Right: Call Icon -->
    <a href="tel:<?php echo $data->mobile_no; ?>" class="call-btn d-flex align-items-center justify-content-center">
        <i class="bi bi-telephone-fill"></i>
    </a>
</div>

<style>
.contact-info {
    padding: 0.5rem 1rem;
}

.call-btn {
    width: 30px;
    height: 30px; /* make it square */
    background-color: #ebebebff; /* dark blue */
    color: #011C55;
    border-radius: 50%; /* circular */
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px; /* smaller icon */
    transition: background 0.3s;
}

.call-btn:hover {
    background-color: #0040a0; /* lighter blue on hover */
    color: #fff;
    text-decoration: none;
}
</style>


        <div class="tracking-list">
            <?php 
            $logs = get_all_list('lead_status_log',' where lead_id='.$data->id.' order by id asc'); 
            foreach($logs as $log):
                $createdBy = get_row('users',' where id='.$log->created_by);
                $status = $log->status == 0 ? 'Created' : get_row('master_table',' where id='.$log->status)->name;
            ?>
            <div class="tracking-item d-flex align-items-start mb-3">

                <!-- Left: Date & Time -->
                <div class="tracking-date text-end me-3" style="min-width: 100px;">
                    <div><?php echo date('d M Y', strtotime($log->created_at)); ?></div>
                    <span><?php echo date('h:i a', strtotime($log->created_at)); ?></span>
                </div>

                <!-- Middle: Icon -->
            <div class="tracking-icon text-center me-3" style="width: 40px;">
    <i class="bi bi-clock-history text-dark" style="font-size: 24px;"></i>
</div>

                <!-- Right: Details -->
                <div class="tracking-details flex-fill">
                    <p><strong>User:</strong> <?php echo $createdBy->name; ?></p>
                    <p><strong>Status:</strong> 
                        <?php if($log->status == 0){ ?>
                            <span class="text-success"><?php echo $status; ?></span>
                        <?php } else { ?>
                            <span class="text-info"><?php echo $status; ?></span>
                        <?php } ?>
                    </p>
                    <p><strong>Next Followup:</strong> 
                        <?php if($log->next_followup != "0000-00-00 00:00:00"){ ?>
                            <?php echo date("d-M-Y h:i a", strtotime($log->next_followup)); ?>
                        <?php } ?>
                    </p>
                    <p><strong>Remark:</strong> <?php echo $log->remark; ?></p>
                </div>

            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

				</div>
			</div>
		</div>
	</div>
</div>
										</div>
									</div>
								</div>
							</div>
							
						</div>
						
					</div>
					
				</div>
			</div>

		</div>
<a href="#" class="floating-btn" onclick="openFeedbackModal()">
    <i class="fa fa-plus"></i>
</a>

<script>
function openFeedbackModal() {
    // Show the Bootstrap feedback modal
    var modal = new bootstrap.Modal(document.getElementById('feedbackForm'));
    modal.show();

    // Optionally, you can set a default lead ID or phone
    document.getElementById('lead_id').value = ''; 
    document.getElementById('modal_title').innerHTML = 'Add Feedback';
}
</script>

		
		
		<?php $this->load->view('Template/footer',$data); ?>
		<style>
			/*.counter-box{ width:50%; }*/
				
.tracking-detail {
 padding:3rem 0
}
#tracking {
 margin-bottom:1rem
}
[class*=tracking-status-] p {
 margin:0;
 font-size:1.1rem;
 color:#fff;
 text-transform:uppercase;
 text-align:center
}
[class*=tracking-status-] {
 padding:1.6rem 0
}
.tracking-status-intransit {
 background-color:#65aee0
}
.tracking-status-outfordelivery {
 background-color:#f5a551
}
.tracking-status-deliveryoffice {
 background-color:#f7dc6f
}
.tracking-status-delivered {
 background-color:#4cbb87
}
.tracking-status-attemptfail {
 background-color:#b789c7
}
.tracking-status-error,.tracking-status-exception {
 background-color:#d26759
}
.tracking-status-expired {
 background-color:#616e7d
}
.tracking-status-pending {
 background-color:#ccc
}
.tracking-status-inforeceived {
 background-color:#214977
}
.tracking-list {

	background-color:#f5f4f4 ;
 border:1px solid #f8f8f8ff
}
.tracking-item {
 border-left:1px solid #e5e5e5;
 position:relative;
 padding:8px;
 font-size:12px;
 margin-left:3rem;
 min-height:5rem
}
.tracking-item:last-child {
 padding-bottom:4rem
}
.tracking-item .tracking-date {
 margin-bottom:.5rem
}
.tracking-item .tracking-date span {
 color:#888;
 font-size:85%;
 padding-left:.4rem
}
.tracking-item .tracking-content {
 padding:.5rem .8rem;
 background-color:#f4f4f4;
 border-radius:.5rem
}
.tracking-item .tracking-content span {
 display:block;
 color:#888;
 font-size:85%
}
.tracking-item .tracking-icon {
 line-height:2.6rem;
 position:absolute;
 left:-1.3rem;
 width:2.6rem;
 height:2.6rem;
 text-align:center;
 border-radius:50%;
 font-size:1.1rem;
 background-color:#fff;
 color:#fff
}
.tracking-item .tracking-icon.status-sponsored {
 background-color:#f68
}
.tracking-item .tracking-icon.status-delivered {
 background-color:#4cbb87
}
.tracking-item .tracking-icon.status-outfordelivery {
 background-color:#f5a551
}
.tracking-item .tracking-icon.status-deliveryoffice {
 background-color:#f7dc6f
}
.tracking-item .tracking-icon.status-attemptfail {
 background-color:#b789c7
}
.tracking-item .tracking-icon.status-exception {
 background-color:#d26759
}
.tracking-item .tracking-icon.status-inforeceived {
 background-color:#214977
}
.tracking-item .tracking-icon.status-intransit {
 color:#011C55;
 border:1px solid #e5e5e5;
 font-size:24px;
}
@media(min-width:992px) {
 .tracking-item {
  margin-left:10rem
 }
 .tracking-item .tracking-date {
  position:absolute;
  left:-10rem;
  width:7.5rem;
  text-align:right
 }
 .tracking-item .tracking-date span {
  display:block
 }
 .tracking-item .tracking-content {
  padding:0;
  background-color:transparent
 }

}
p{ margin-bottom:0px!important;}
		</style>
        <!-- Add Number Modal -->
<!-- Add Number Modal -->
<!-- Add Number Modal -->
<div class="modal fade" id="addNumberModal" tabindex="-1" aria-labelledby="addNumberLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-3">
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold text-dark" id="addNumberLabel">
          <i class="fa-solid fa-phone me-2 text-success"></i> Add Phone Numbers
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="card border-0 shadow-sm rounded-3">
          <div class="card-body">
            <p class="text-muted small mb-3">
              Add one or more phone numbers. Click <span class="text-success fw-semibold">+</span> to add more, or <span class="text-danger fw-semibold">🗑️</span> to remove.
            </p>
<?php 
$lead_id = $this->uri->segment(3); // assuming URL is like: /Leads/save_additional_numbers/316
?>
            <!-- FORM -->
<form id="addNumbersForm" method="post" action="<?= base_url('Leads/save_additional_numbers/'.$lead_id) ?>">
    <div id="phone_numbers_container">
        <div class="input-group mb-2 phone-number-field">
            <input type="text" name="phone_numbers[]" class="form-control form-control-sm" placeholder="Enter phone number" required>
            <button type="button" class="btn btn-outline-success btn-sm add-number-btn" title="Add another number">
                <i class="fa-solid fa-circle-plus"></i>
            </button>
        </div>
    </div>

    <div class="mt-3 text-end">
        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-check me-1"></i> Save
        </button>
    </div>
</form>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>

document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('phone_numbers_container');
    const form = document.getElementById('addNumbersForm');

    // Add/remove fields dynamically
    container.addEventListener('click', function(e) {
        if (e.target.closest('.add-number-btn')) {
            const newField = document.createElement('div');
            newField.classList.add('input-group', 'mb-2', 'phone-number-field');
            newField.innerHTML = `
                <input type="text" name="phone_numbers[]" class="form-control form-control-sm" placeholder="Enter phone number" required>
                <button type="button" class="btn btn-outline-danger btn-sm remove-number-btn" title="Remove number">
                    <i class="fa-solid fa-trash"></i>
                </button>
            `;
            container.appendChild(newField);
        }

        if (e.target.closest('.remove-number-btn')) {
            e.target.closest('.phone-number-field').remove();
        }
    });

    // Validate before submit
    form.addEventListener('submit', function(e) {
        let hasError = false;

        form.querySelectorAll('input[name="phone_numbers[]"]').forEach(input => {
            const val = input.value.trim();
            const regex = /^(\+91)?\d{10}$/;

            if (!regex.test(val)) {
                hasError = true;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (hasError) {
            e.preventDefault();
            alert("❌ Enter valid phone numbers (10 digits or +91XXXXXXXXXX).");
        }
    });
});
</script>


</script>
<style>
/* Highlight invalid fields */
.is-invalid {
    border-color: #dc3545 !important;
}
</style>




		<!-- Feedback Modal -->
<div class="modal fade" id="feedbackForm" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?php echo base_url(); ?>Leads/feedbackForm" method="post">
                <input type="hidden" name="lead_id" id="lead_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <?php 
                $user = $this->session->userdata('user_info');
                $user_id = $user->id;
                $role_id = $user->role;
                $parent_id = $user_id;
                if(!in_array($role_id,[1,2])){
                    $userRow = $this->db->select('parent_id')->from('users')->where('id',$user_id)->get()->row();
                    if($userRow) $parent_id = $userRow->parent_id;
                }
                ?>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Priority</label>
                        <select class="form-select" name="priority_id" required>
                            <option value="">-- Select Priority --</option>
                            <?php 
                            $result = get_all_list('master_table', " WHERE type='priority' AND parent_id = $parent_id"); 
                            foreach($result as $row){ ?>
                                <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <select class="form-select" name="status_id" required>
                            <option value="">-- Select Status --</option>
                            <?php 
                            $result = get_all_list('master_table', " WHERE type='status' AND parent_id = $parent_id"); 
                            foreach($result as $row){ ?>
                                <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Next Meeting Date & Time</label>
                        <input type="datetime-local" name="next_followup" class="form-control" placeholder="Select date and time">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Remark</label>
                        <textarea class="form-control" name="remark" placeholder="Enter remark" rows="3"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
let currentNumbers = [];

function openWhatsAppBox(mainNumber, addNumbers) {
    const box = document.getElementById("whatsappBox");
    box.style.display = "flex";

    // Combine main number and additional numbers
    currentNumbers = [mainNumber];
    if(addNumbers) {
        const extraNumbers = addNumbers.split(',').map(num => num.trim()).filter(Boolean);
        currentNumbers = currentNumbers.concat(extraNumbers);
    }

    // Populate dropdown
    const select = document.getElementById("whatsappSelectNumber");
    select.innerHTML = '';
    currentNumbers.forEach(num => {
        const option = document.createElement('option');
        option.value = num;
        option.textContent = num;
        select.appendChild(option);
    });

    document.getElementById("whatsappMessage").focus();
}

function closeWhatsAppBox() {
    document.getElementById("whatsappBox").style.display = "none";
    document.getElementById("whatsappMessage").value = "";
}

// Send WhatsApp message
function sendWhatsApp() {
    const message = document.getElementById("whatsappMessage").value.trim();
    if (!message) {
        alert("Please type a message first.");
        return;
    }

    const selectedNumber = document.getElementById("whatsappSelectNumber").value;
    const url = "https://wa.me/" + selectedNumber + "?text=" + encodeURIComponent(message);
    window.open(url, "_blank");

    closeWhatsAppBox();
}

// ---------------- Drag for Desktop & Mobile ----------------
dragElement(document.getElementById("whatsappBox"));

function dragElement(elmnt) {
    const header = document.getElementById("whatsappHeader");
    let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;

    header.addEventListener('mousedown', dragMouseDown);
    header.addEventListener('touchstart', dragTouchStart, {passive:false});

    function dragMouseDown(e) {
        e.preventDefault();
        pos3 = e.clientX;
        pos4 = e.clientY;
        document.onmouseup = closeDragElement;
        document.onmousemove = elementDrag;
    }

    function elementDrag(e) {
        e.preventDefault();
        pos1 = pos3 - e.clientX;
        pos2 = pos4 - e.clientY;
        pos3 = e.clientX;
        pos4 = e.clientY;
        elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
        elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
    }

    function closeDragElement() {
        document.onmouseup = null;
        document.onmousemove = null;
    }

    function dragTouchStart(e) {
        e.preventDefault();
        const touch = e.touches[0];
        pos3 = touch.clientX;
        pos4 = touch.clientY;
        document.ontouchend = closeTouchDrag;
        document.ontouchmove = elementTouchDrag;
    }

    function elementTouchDrag(e) {
        e.preventDefault();
        const touch = e.touches[0];
        pos1 = pos3 - touch.clientX;
        pos2 = pos4 - touch.clientY;
        pos3 = touch.clientX;
        pos4 = touch.clientY;
        elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
        elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
    }

    function closeTouchDrag() {
        document.ontouchend = null;
        document.ontouchmove = null;
    }
}
</script>

       </body>


	</html>