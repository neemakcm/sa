<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('role_permission', function(Blueprint $table) {
			$table->foreign('role_id')->references('id')->on('roles')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('role_permission', function(Blueprint $table) {
			$table->foreign('permission_id')->references('id')->on('permissions')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('categories', function(Blueprint $table) {
			$table->foreign('parent_id')->references('id')->on('categories')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('category_attributes', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('category_attributes', function(Blueprint $table) {
			$table->foreign('attribute_id')->references('id')->on('attributes')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->foreign('parent_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('product_images', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('product_attributes', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('product_attributes', function(Blueprint $table) {
			$table->foreign('attribute_id')->references('id')->on('attributes')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('product_online', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('product_reviews', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('product_support', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('product_support', function(Blueprint $table) {
			$table->foreign('support_id')->references('id')->on('support_options')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('product_faq', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('product_compare', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('user_manual', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('user_manual', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('warranty', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('product_feedback', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('job_requests', function(Blueprint $table) {
			$table->foreign('job_id')->references('id')->on('jobs')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('job_request_educations', function(Blueprint $table) {
			$table->foreign('job_request_id')->references('id')->on('job_requests')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('role_permission', function(Blueprint $table) {
			$table->dropForeign('role_permission_role_id_foreign');
		});
		Schema::table('role_permission', function(Blueprint $table) {
			$table->dropForeign('role_permission_permission_id_foreign');
		});
		Schema::table('categories', function(Blueprint $table) {
			$table->dropForeign('categories_parent_id_foreign');
		});
		Schema::table('category_attributes', function(Blueprint $table) {
			$table->dropForeign('category_attributes_category_id_foreign');
		});
		Schema::table('category_attributes', function(Blueprint $table) {
			$table->dropForeign('category_attributes_attribute_id_foreign');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('products_category_id_foreign');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('products_parent_id_foreign');
		});
		Schema::table('product_images', function(Blueprint $table) {
			$table->dropForeign('product_images_product_id_foreign');
		});
		Schema::table('product_attributes', function(Blueprint $table) {
			$table->dropForeign('product_attributes_product_id_foreign');
		});
		Schema::table('product_attributes', function(Blueprint $table) {
			$table->dropForeign('product_attributes_attribute_id_foreign');
		});
		Schema::table('product_online', function(Blueprint $table) {
			$table->dropForeign('product_online_product_id_foreign');
		});
		Schema::table('product_reviews', function(Blueprint $table) {
			$table->dropForeign('product_reviews_product_id_foreign');
		});
		Schema::table('product_support', function(Blueprint $table) {
			$table->dropForeign('product_support_product_id_foreign');
		});
		Schema::table('product_support', function(Blueprint $table) {
			$table->dropForeign('product_support_support_id_foreign');
		});
		Schema::table('product_faq', function(Blueprint $table) {
			$table->dropForeign('product_faq_product_id_foreign');
		});
		Schema::table('product_compare', function(Blueprint $table) {
			$table->dropForeign('product_compare_product_id_foreign');
		});
		Schema::table('user_manual', function(Blueprint $table) {
			$table->dropForeign('user_manual_category_id_foreign');
		});
		Schema::table('user_manual', function(Blueprint $table) {
			$table->dropForeign('user_manual_product_id_foreign');
		});
		Schema::table('warranty', function(Blueprint $table) {
			$table->dropForeign('warranty_product_id_foreign');
		});
		Schema::table('product_feedback', function(Blueprint $table) {
			$table->dropForeign('product_feedback_product_id_foreign');
		});
		Schema::table('job_requests', function(Blueprint $table) {
			$table->dropForeign('job_requests_job_id_foreign');
		});
		Schema::table('job_request_educations', function(Blueprint $table) {
			$table->dropForeign('job_request_educations_job_request_id_foreign');
		});
	}
}