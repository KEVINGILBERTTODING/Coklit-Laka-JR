<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
	<?php foreach ($this->uri->segments as $segment) : ?>
		<?php
		$url = substr($this->uri->uri_string, 0, strpos($this->uri->uri_string, $segment)) . $segment;
		$is_active =  $url == $this->uri->uri_string;
		?>


		<li class="breadcrumb-item text-sm text-white active" aria-current="page" <?php echo $is_active ? 'active' : '' ?>">
			<?php if ($is_active) : ?>
				<?php echo ucfirst($segment) ?>
			<?php else : ?>
				<a class="opacity-5 text-white" href="<?php echo site_url($url) ?>"><?php echo ucfirst($segment) ?></a>
			<?php endif; ?>
		</li>
	<?php endforeach; ?>
</ol>
