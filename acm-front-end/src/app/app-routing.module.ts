import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { ChargedFeesComponent } from './app/charged-fees/charged-fees.component';


const routes: Routes = [
	{ path: 'charged-fees', component: ChargedFeesComponent },
	{ path: '',   redirectTo: '/charged-fees', pathMatch: 'full' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
