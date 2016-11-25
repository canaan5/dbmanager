///<reference path="../../../../typings/index.d.ts"/>

import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpModule } from '@angular/http'
import { FormsModule } from '@angular/forms'
import { RouterModule, Routes } from '@angular/router'

import { ROUTES } from './routes';

import { AbbroseAppComponent } from './abbrose-app.component';
import { HeaderComponent } from './component/header.component';
import { HomeComponent } from './component/home.component';
import { LookbookComponent } from './component/lookbook.component';
import { BlogComponent } from './component/blog.component';
import { BlogListComponent } from './component/blog-list.component';
import { SinglePostComponent } from './component/single-post.component';
import { ContactComponent } from './component/contact.component';
import { AboutComponent } from './component/about.component';
import { HomeSlideComponent } from './component/home-slide.component';
import { CommentFormComponent } from './component/comment-form.component';
import { LookbookService } from './libs/lookbook-service';
import { BlogService } from './libs/blog-service';

@NgModule({
    imports: [
        BrowserModule, 
        HttpModule,
        FormsModule,
        RouterModule.forRoot(<Routes>ROUTES, { useHash: true })
    ],
    declarations: 
    [
        AbbroseAppComponent,
        HeaderComponent,
        HomeComponent,
        LookbookComponent,
        HomeSlideComponent,
        ContactComponent,
        AboutComponent,
        BlogComponent,
        BlogListComponent,
        SinglePostComponent,
        CommentFormComponent
    ],
    providers: [LookbookService, BlogService],
    bootstrap: [AbbroseAppComponent]
})

export class AppModule {}