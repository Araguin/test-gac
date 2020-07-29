import { Component, OnInit } from '@angular/core';
import { Validators, FormGroup, FormControl } from '@angular/forms';
import { HttpEventType } from '@angular/common/http';
import { ChargedFeesService } from '../service/charged-fees.service';
import { ChargedFees } from '../model/charged-fees.model';
import { Observable, throwError } from 'rxjs';

@Component({
  selector: 'app-charged-fees',
  templateUrl: './charged-fees.component.html',
  styleUrls: ['./charged-fees.component.scss']
})
export class ChargedFeesComponent implements OnInit {
  progress: number;
  public form: FormGroup;
  chargedFees: ChargedFees[];
  displayedColumns: string[] = ['name', 'state', 'totalRows', 'errors'];
  isLoading: boolean;
      
  constructor(protected _chargedFeesService: ChargedFeesService) {
  }

  ngOnInit(): void {
  	this.form = new FormGroup({
  		file: new FormControl(null, [Validators.required, requiredFileType('csv')])
    });
    this.loadChargedFees();
  }

	submit() {
    this.isLoading = true;
    this._chargedFeesService.createChargedFees(this.form.value).subscribe(event => {
        this.form.reset();
        this.isLoading = false;
        this.loadChargedFees();
  	});
  }

  loadChargedFees(){
    this.isLoading = true;
    this._chargedFeesService.getChargedFees().subscribe(event => {
      this.chargedFees = event['hydra:member'];
      this.isLoading = false;
    });
  }

}

export function requiredFileType( type: string ) {
  return function (control: FormControl) {
    const file = control.value;
    if ( file ) {
      const extension = file.name.split('.')[1].toLowerCase();
      if ( type.toLowerCase() !== extension.toLowerCase() ) {
        return {
          requiredFileType: true
        };
      }
      
      return null;
    }

    return null;
  };
}

export function toFormData<T>( formValue: T ) {
  const formData = new FormData();

  for ( const key of Object.keys(formValue) ) {
    const value = formValue[key];
    formData.append(key, value);
  }

  return formData;
}