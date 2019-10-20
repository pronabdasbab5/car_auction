<li role="presentation" class="dropdown">
    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-envelope-o"></i>
        <span class="badge bg-green">
        	({{ ($newData['newMemberData']) > 0? ($newData['newMemberData']): 0  }})
        </span>
        @if($newData['newMemberData'] > 0)
        	<ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
        		@if($newData['newMemberData'] > 0)
        			<li><a href="#"><b>({{ $newData['newMemberData'] }}) New Users </b></a></li>
        		@endif
        	</ul>
        @endif
    </a>
</li>